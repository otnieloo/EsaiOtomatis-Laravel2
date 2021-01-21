<?php

namespace App\Exports;

use App\Similarity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SimilarityExport implements FromCollection,WithHeadings
{
    protected $id_ujian;
    
    public function __construct($id_ujian){
        $this->id_ujian = $id_ujian;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return Similarity::join('answers','similarities.id_jawaban','=','answers.id_jawaban')
                        ->where('answers.id_ujian',$this->id_ujian)
                        ->join('students','students.id_siswa','=','answers.id_siswa')
                        ->join('questions','questions.id_soal','=','similarities.id_soal')
                        ->select('nama','email','pertanyaan','jawaban','nilai_similaritas','nilai_similaritasqe','nilai_konversi','nilai_konversiqe')
                        ->get();
    }

    public function headings():array
    {
        return [
            'Nama',
            'Email',
            'Pertanyaan',
            'Jawaban',
            'Nilai Similaritas',
            'Nilai Similaritas QE',
            'Nilai Konversi', 
            'Nilai Konversi QE', 
        ];
    }
}
