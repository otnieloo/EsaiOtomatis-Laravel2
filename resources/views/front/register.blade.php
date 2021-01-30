@extends('front/main')

@section('content')
    <div class="container">
        <div class="registerCard card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('failed'))
                                <div class="alert alert-danger">
                                    {{ session('failed') }}
                                </div>
                            @endif
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user registerForm" action="/register" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user"  placeholder="Nama" name="nama" value="{{old('nama')}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user"  placeholder="Username" name="username" value="{{old('username')}}">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" placeholder="Email" name="email" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" placeholder="Password" name="password">                                    
                                </div>
                                <div class="form-group">
                                    <select name="role" id="roleRegister" class="custom-select">
                                        <option value="" selected>Pilih Role</option>
                                        <option value="1">Pengajar</option>
                                        <option value="2">Siswa</option>                                       
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                {{-- <a class="small" href="forgot-password.html">Forgot Password?</a> --}}
                            </div>
                            <div class="text-center">
                                <a class="small" href="/login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection