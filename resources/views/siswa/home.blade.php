@extends('siswa/main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Ujian</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Daftar Hasil Ujian</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered" id="ujianTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Ujian</th>
                                        <th scope="col">Pengajar</th>
                                        <th scope="col">Jumlah Soal</th>
                                        <th scope="col">Kode Ujian</th>
                                        <th scope="col">Jadwal</th>
                                        <th scope="col">Jadwal Selesai</th>
                                        <th scope="col">Durasi</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ujian AS $u)
                                    @php
                                        $u = $u[0];
                                    @endphp
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$u->nama}}</td>
                                    <td>{{$pengajar[$loop->iteration-1][0]->nama}}</td>
                                    <td>{{$u->jumlah_soal}}</td>
                                    <td>{{$u->kode_ujian}}</td>
                                    <td>{{$u->jadwal}}</td>
                                    <td>{{$u->jadwal_selesai}}</td>
                                    <td>{{$u->durasi.' menit'}}</td>
                                    <td>
                                        @switch($u->status)
                                            @case(1)
                                                <div class="badge badge-success">Ongoing</div>
                                                @break
                                            @case(2)
                                                <div class="badge badge-danger">Ended</div>
                                                @break
                                            @default
                                                <div class="badge badge-warning">Pending</div>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($u->status)
                                            @case(1)
                                                <div class="badge badge-info">
                                                    <a href="/lihat_ujian/{{$u->id_ujian}}" class="text-white p-1"><i class="fas fa-eye"></i></a>
                                                </div>
                                                <div class="badge badge-primary">
                                                    <a href="/isi_ujian/{{$u->id_ujian}}" class="text-white p-1"><i class="fas fa-pencil-alt"></i></a>
                                                </div>
                                                @break
                                            @case(2)
                                                <div class="badge badge-info">
                                                    <a href="/lihat_ujian/{{$u->id_ujian}}" class="text-white p-1"><i class="fas fa-eye"></i></a>
                                                </div>
                                                <div class="badge badge-primary">
                                                    <a href="/isi_ujian/{{$u->id_ujian}}" class="text-white p-1"><i class="fas fa-pencil-alt"></i></a>
                                                </div>

                                                @break
                                            @default
                                                <div class="badge badge-info">
                                                    <a href="/lihat_ujian/{{$u->id_ujian}}" class="text-white p-1"><i class="fas fa-eye"></i></a>
                                                </div>
           
                                                @break
                                        @endswitch
                                    </td>
                                  </tr>
                                @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <!-- /.container-fluid -->  
@endsection