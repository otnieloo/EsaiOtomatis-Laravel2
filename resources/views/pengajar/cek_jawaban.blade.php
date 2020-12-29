@extends('pengajar/main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hasil Ujian XXX - (nama)</h1>
        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="container-fluid">

                <!-- Page Heading -->
                {{-- <h1 class="h3 mb-2 text-gray-800">Daftar Hasil Ujian</h1> --}}

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="dataUjian d-flex flex-row">
                            <div class="item">
                                Nama Siswa:
                            </div>
                            <div class="item">
                                Nilai Sistem:
                            </div>
                        </div>
                        <div class="soalUjian">
                            Soal:
                            <ol type="1">
                                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, atque.</li>
                                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, atque.</li>
                                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, atque.</li>
                                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, atque.</li>
                                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, atque.</li>
                            </ol>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                        <div class="nextPrevButton mx-auto">
                            <button class="btn btn-primary">Previous</button>
                            <button class="btn btn-primary">Next</button>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <!-- /.container-fluid -->  
@endsection