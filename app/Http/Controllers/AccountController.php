<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Teacher;
use App\Student;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function home()
    {
        return view('front.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.register');
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
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        
        try{
            $role = $request->role;
            if($role == '1'){
                // Pengajar
                Teacher::create($data);
            }else{
                // Siswa
                Student::create($data);
            }
            return redirect('/login')->with('success','Account created successfully. Please login.'); 

        }catch(QueryException $e){
            switch($e->errorInfo[1]){
                case '1062':
                    return redirect('/register')->with('failed','Username or email already exists.'); 
                    
                    break;
                default:
                    return redirect('/register')->with('failed','Error. Contact administrator.'); 
                
                    break;
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Custom function for login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        
        $role = $request->role;
        if($role == '1'){
            // Pengajar
            $teacher = Teacher::where('email',$request->email)->get();
            if(empty($teacher[0])){
                return redirect('/login')->with('failed_exist','Doesnt match our records.'); 
            }

            $password = $teacher[0]->password;
            $check = Hash::check($request->password,$password);

            if(!$check){
                return redirect('/login')->with('failed_exist','Doesnt match our records.'); 
            }

            // Session
            $request->session()->put('role','1');
            $request->session()->put('email',$request->email);

            return redirect('/pengajar'); 

        }else{
            // Siswa
            $student = Student::where('email',$request->email)->get();
            if(empty($student[0])){
                return redirect('/login')->with('failed_exist','Doesnt match our records.'); 
            }

            $password = $student[0]->password;
            $check = Hash::check($request->password,$password);

            if(!$check){
                return redirect('/login')->with('failed_exist','Doesnt match our records.'); 
            }

            // Session
            $request->session()->put('role','2');
            $request->session()->put('email',$request->email);
            
            return redirect('/siswa');  
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        return response()->json($response); 

    }
}
