<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Exam;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DateTime;
use DateInterval;

class PengajarController extends Controller
{
    protected $pengajar;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            
            if($request->session()->get('role') != 1){
                return redirect('/login')->with('failed_exist','Not authorized!');
            }

            $this->pengajar = Teacher::where('email',$request->session()->get('email'))->get();
           return $next($request);
     });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Data ujian berdasarkan id pengajar
        $pengajar = $this->pengajar;
        // dd($pengajar);
        $ujian = Exam::where('id_pengajar',$pengajar[0]->id_pengajar)->get();

        return view('pengajar.home',compact('ujian','pengajar'));
    }

    /**
     * Display view halaman buat ujian
     * 
     * @return void
     * 
     */

    public function buatUjian()
    {
        $pengajar = $this->pengajar;
        return view('pengajar.buat_ujian',compact('pengajar'));
    }

    /**
     * Display view halaman edit ujian
     * 
     * @return void
     * 
     */

    public function editUjian($id,Request $request)
    {
        $pengajar = $this->pengajar;
        $ujian = Exam::where('id_ujian',$id)->get();

        if(!isset($ujian[0])){
            switch($request->session()->get('role')){
                case '1':
                    return redirect('/pengajar');
                    break;
                case '2':
                    return redirect('/siswa');
                    break;
                default:
                    return redirect('/');
                    break;
            }
        }

        $ujian = $ujian[0];

        // Soal dan jawaban
        $soal = Question::where('id_ujian',$ujian->id_ujian)->get();

        return view('pengajar.edit_ujian',compact('pengajar','ujian','soal'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jadwal' => 'required',
            'durasi' => 'required | numeric | min: 10 | max: 180',
            'soal.*' => 'required',
            'jawaban.*' => 'required',
        ]);

        // Generate kode ujian
        $kode_ujian = str_random(5);
        while ($this->cekKode($kode_ujian) == true) {
            $kode_ujian = str_random(5);
        }

        // Calculate jadwal selesai

        $time = new DateTime($request->jadwal);
        $time->add(new DateInterval('PT' . $request->durasi . 'M'));

        $jadwal_selesai = $time->format('Y-m-d H:i');

        $data = [
            'nama' => $request->nama,
            'jadwal' => $request->jadwal,
            'jadwal_selesai' => $jadwal_selesai,
            'durasi' => $request->durasi,
            'jumlah_soal' => count(collect($request)->get('soal')),
            'id_pengajar' => $this->pengajar[0]->id_pengajar,
            'kode_ujian' => $kode_ujian,
        ];

        // Insert to exams table
        try{

            Exam::create($data);       

        }catch(QueryException $e){
            dd($e->errorInfo);
        }

        // Insert to questions table with id_ujian
        try{
            
            $ujian = Exam::where('kode_ujian',$kode_ujian)->get();
            
            if(isset($ujian[0])){
                $id_ujian = $ujian[0]->id_ujian;
                $count = 0;
                foreach($request->get('soal') as $soal){
                    try{
                        Question::create([
                            'id_ujian' => $id_ujian,
                            'pertanyaan' => $soal,
                            'kunci_jawaban' => $request->get('jawaban')[$count]
                        ]);
                    }catch(QueryException $e){
                        dd($e->errorInfo);
                    }
                    $count++;
                }

                return redirect('/buat_ujian')->with('success',"Ujian berhasil dibuat dengan kode ujian $kode_ujian!");
            }

        }catch(QueryException $e){

        }
 



        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    /**
     * Cek duplikasi kode ujian
     *
     * @param string $kode_ujian
     * @return bool
     */
    public function cekKode($kode_ujian)
    {
        $ujian = Exam::where('kode_ujian',$kode_ujian)->get();
        
        if(!isset($ujian[0])){
            return false;
        }else{
            return true;
        }
    }

    
}
