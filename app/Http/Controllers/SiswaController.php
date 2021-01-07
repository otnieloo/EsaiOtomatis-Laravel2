<?php

namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
use App\Enroll;
use App\Exam;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    protected $siswa;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            
            if($request->session()->get('role') == 1){
                return redirect('/pengajar');
            }else if($request->session()->get('role') == null){
                return redirect('/login')->with('failed_exist','Not authorized!');
            }

            $this->siswa = Student::where('email',$request->session()->get('email'))->get();
           return $next($request);
     });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Ujian $ujian
     * @return \Illuminate\Http\Pengajar $pengajar*/
    public function index()
    {
        //
           // Data ujian berdasarkan id pengajar
           $siswa = $this->siswa;
        //    dd($siswa);

            $ujian = array();
            $pengajar = array();
           
            $enroll = Enroll::where('id_siswa',$siswa[0]->id_siswa)
               ->get();

            if(isset($enroll[0])){   
                foreach($enroll as $e){
                    $ujian[] = Exam::where('id_ujian',$e->id_ujian)->get();
                }

                foreach($ujian as $u){
                    $pengajar[] = Teacher::where('id_pengajar',$u[0]->id_pengajar)->get();
                }

            }

           return view('siswa.home',compact('siswa','ujian','pengajar'));
    }

    /**
     * Display halaman enroll.
     *
     * @return void
     */
    public function enroll()
    {
        $siswa = $this->siswa;
        return view('siswa.enroll_ujian',compact('siswa'));
    }

        /**
     * Display halaman lihat ujian
     *
     * @return void
     */
    public function lihatUjian($id = null)
    {
        $siswa = $this->siswa;
        $exam = Enroll::where('id_siswa',$siswa[0]->id_siswa)
            ->leftJoin('exams','enrolls.id_ujian','=','exams.id_ujian')
            ->get();
        
        if(is_null($id)){
            return view('siswa.lihat_ujian',compact('siswa','exam'));
        }

        $examInfo = Enroll::where('enrolls.id_ujian',$id)
            ->leftJoin('exams','exams.id_ujian','=','enrolls.id_ujian')
            ->get();

        if(!isset($examInfo[0])){
            return redirect('/lihat_ujian');
        }

        try{
            $question = Question::where('id_ujian',$id)
                ->leftJoin('answers','questions.id_soal','=','answers.id_soal')
                ->where('answers.id_siswa',$this->siswa[0]->id_siswa)
                ->get();
        }catch(QueryException $e){
            dd($e->errorInfo);
        }

        return view('siswa.lihat_ujian',compact('siswa','exam','examInfo','question'));
    }

    /**
     * Display halaman isi ujian.
     *
     * @return void
     */
    public function isiUjian($id)
    {
        $status = 'ok';
        // Cek jika sudah pernah mengisi
        try {
            $question = Question::where('id_ujian',$id)
                ->get();
        } catch (DecryptException $e) {
            dd($e);
        }

        $answer = Answer::where('id_soal',$question[0]->id_soal)
            ->where('id_siswa',$this->siswa[0]->id_siswa)
            ->get();

        if(isset($answer[0])){
            return redirect('/siswa')->with('error','You already answered this exam.');
        }

        // Cek jika pending belum bisa isi soal
        try{
            $ujian = Exam::where('id_ujian',$id)->first();
            if($ujian->status == '0'){
                return redirect('/siswa')->with('error','Exam has not started yet.');
            }else if($ujian->status == '2'){
                $status = 'late';
            }
        }catch(QueryException $e){
            dd($e->errorInfo);
        }

        $siswa = $this->siswa;
        try{
            $ujian = Exam::where('id_ujian',$id)->first();
            if(isset($ujian)){
                $id_hash = Crypt::encryptString($id);
            }
            $question = Question::where('id_ujian',$id)->get();
        }catch(QueryException $e){
            dd($e->errorInfo);
        }
        return view('siswa.isi_soal',compact('siswa','ujian','question','id_hash','status'));

    }

    /**
     * Cek info ujian untuk enroll.
     *
     * @return void
     */
    public function cekEnroll(Request $request)
    {
        $ujian = Exam::where('kode_ujian',$request->kode_ujian)
            ->leftJoin('teachers','exams.id_pengajar','=','teachers.id_pengajar')
            ->first();
        if(isset($ujian)){
            echo json_encode($ujian);
        }else{
            echo 'failed';
        }
    }

    /**
     * Insert enroll ujian
     * @param Illuminate\Http\Request
     *  
     * @return \Illuminate\Http\Response
     */
    public function enrollUjian(Request $request)
    {
        // Cek apakah sudah enroll
        $enroll = Enroll::where('id_siswa',$this->siswa[0]->id_siswa)->first();
        if(isset($enroll) && $enroll->id_ujian == $request->id_ujian){
            echo json_encode([
                'status' => 'failed',
                'message' => 'You are already enrolled.'
            ]);

            die;
        }

        // Cek status ujian
        $ujian = Exam::where('id_ujian',$request->id_ujian)->first();
        if($ujian->status == '2'){
            echo json_encode([
                'status' => 'failed',
                'message' => 'Ujian has ended. You are late.'
            ]);

            die;
        }

        $data = [
            'id_ujian' => $request->id_ujian,
            'id_siswa' => $this->siswa[0]->id_siswa,
            'status'   => '1'
        ];

        try{
            Enroll::create($data);
        }catch(QueryException $e){
            $error = $e->errorInfo;
        }

        if(!isset($error)){
            echo json_encode([
                'status' => 'true',
                'message' => 'Congratulations and good luck!'   
            ]);
        }else{
            echo json_encode([
                'status' => 'failed',
                'message' => $error
            ]);
        }

    }

    /**
     * Submit isi ujian
     * @param Illuminate\Http\Request
     *  
     * @return \Illuminate\Http\Response
     */
    public function submitIsiUjian(Request $request)
    {
        $validatedData = $request->validate([
            'jawaban.*' => 'required'
        ]);

        try {
            $ujian = Exam::where('id_ujian',Crypt::decryptString($request->id))->first();
            $question = Question::where('id_ujian',Crypt::decryptString($request->id))->get();
        } catch (DecryptException $e) {
            dd($e);
        }

        if(isset($ujian)){
            $count = 0;
            foreach($request->jawaban as $j){
                try{
                    $data = [
                        'id_soal' => $question[$count]->id_soal,
                        'id_siswa' => $this->siswa[0]->id_siswa,
                        'jawaban' => $j
                    ];
                    Answer::create($data);
                    $count++;
                }catch(QueryException $e){
                    dd($e->errorInfo);
                }            
            }

            return redirect('/siswa')->with('success','Berhasil. Semoga mendapatkan hasil yang terbaik.');
        }else{
            echo 'not found ';
        }    

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
