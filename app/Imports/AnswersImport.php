<?php

namespace App\Imports;

use App\Answer;
use App\Exam;
use App\Question;
use App\Similarity;
use App\Score;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Database\QueryException;
use GuzzleHttp\Client;

class AnswersImport implements ToCollection
{
    protected $id_ujian;
    protected $id_siswa;
    
    public function __construct($id_ujian,$id_siswa)
    {
        $this->id_ujian = $id_ujian;
        $this->id_siswa = $id_siswa;
        // ini_set('max_execution_time', 900); //300 seconds = 5 minutes
    }
    
    /**
    * @param Collection $collection
    */
    
    public function collection(Collection $collection)
    {
        //
        $id_siswa = $this->id_siswa;
        $count = 1;
        $jawaban_siswa = array();
        $total_waktu = 0;
        $jumlah_soal = 5;
        foreach($collection as $c){
            $time_start = microtime(true);

            if($c[0]==='Timestamp'){
                continue;
            }

            $jawaban_siswa[] = $c[1];
            $jawaban_siswa[] = $c[2];
            $jawaban_siswa[] = $c[3];
            $jawaban_siswa[] = $c[4];
            $jawaban_siswa[] = $c[5];
            // Submit isi ujian
            $ujian = Exam::where('id_ujian',$this->id_ujian)->first();
            $question = Question::where('id_ujian',$this->id_ujian)->get();
            if(isset($ujian)){
                $count = 0;
                $total_nilai = array();
                $total_nilaiqe = array();
                foreach($jawaban_siswa as $j){
                    try{
                        $id_soal = $question[$count]->id_soal;
                        $data = [
                            'id_soal' => $id_soal,
                            'id_siswa' => $id_siswa,
                            'id_ujian' => $ujian->id_ujian,
                            'jawaban' => $j
                        ];

                        $ans = Answer::create($data);
                        if($ans){
                            echo 'answer ok, ';
                        }
                        // Submit similaritas
                        $similaritas = $this->cekSimilaritas($id_soal,$j);
                        $jawaban = Answer::where('id_soal',$id_soal)
                                        ->where('id_siswa',$id_siswa)
                                        ->first();
                        if(isset($similaritas)){
                            if($similaritas->cosine1 >= 0.7){
                                $nilai_konversi = 2;
                            }else if($similaritas->cosine1 >= 0.4){
                                $nilai_konversi = 1;
                            }else if($similaritas->cosine1 >= 0.1){
                                $nilai_konversi = 0.5;
                            }else{
                                $nilai_konversi = 0;
                            }

                            if($similaritas->cosine2 >= 0.7){
                                $nilai_konversiqe = 2;
                            }else if($similaritas->cosine2 >= 0.4){
                                $nilai_konversiqe = 1;
                            }else if($similaritas->cosine2 >= 0.1){
                                $nilai_konversiqe = 0.5;
                            }else{
                                $nilai_konversiqe = 0;
                            }

                            $data = [
                                'id_jawaban'          => $jawaban->id_jawaban,
                                'id_soal'          => $id_soal,
                                'nilai_similaritas'   => $similaritas->cosine1,
                                'nilai_similaritasqe' => $similaritas->cosine2,
                                'nilai_sistem'        => $similaritas->cosine2,
                                'nilai_konversi'        => $nilai_konversi,
                                'nilai_konversiqe'        => $nilai_konversiqe
                            ];
                            $sim = Similarity::create($data);
                            if($sim){
                                echo 'similarity ok, ';
                            }
                            $total_nilai[] = $similaritas->cosine1;
                            $total_nilaiqe[] = $similaritas->cosine2;
                        }else{
                            dd('API Offline');
                        }
                        $count++;
                    }catch(QueryException $e){
                        dd($e->errorInfo);
                    }            
                }

                // Hitung total nilai
                try{
                    $data = [
                        'id_ujian' => $this->id_ujian,
                        'id_siswa' => $id_siswa,
                        'total_nilai' => array_sum($total_nilai)/$jumlah_soal,
                        'total_nilaiqe' => array_sum($total_nilaiqe)/$jumlah_soal
                    ];
                    $sco = Score::create($data);
                    if($sco){
                        echo 'score ok, jumlah_soal: '.$jumlah_soal;
                    
                    }
                }catch(QueryException $e){
                    dd($e->errorInfo);
                }
            }else{
                echo 'not found ';
            }    
            
            echo 'ok done<br>';
            $count++;
            $id_siswa++;
 
            unset($jawaban_siswa);
            $time_end = microtime(true);
            $time = $time_end - $time_start;
            $total_waktu+= $time;
            echo "Process Time: {$time}<br>";
            if($id_siswa > 40){
                break;
            }
            // if($count > 1){
            //     break;
            // }
        }
        echo "Total waktu: ".$total_waktu;
    }

    /**
     * Consume API.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function cekSimilaritas($id_soal,$jawaban)
    {
        try{
            $question = Question::where('id_soal',$id_soal)->first();
        }catch(QueryException $e){
            $e->errorInfo;
        }

        $client = new Client();
        $url = 'http://localhost:5000/';
        
        $data = [
            'form_params'=>[
                'kalimat1' => $question->kunci_jawaban,
                'kalimat2' => $jawaban
            ]
        ];

        $response = $client->post($url,$data);
        
        $result = $response->getBody()->getContents();
       
        return json_decode($result);

    }
}
