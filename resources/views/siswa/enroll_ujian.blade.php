@extends('siswa/main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            {{-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> --}}
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h1 class="h3 mb-2 text-gray-800 text-center">Enroll Ujian</h1>
                        <div class="enrollUjian">
                            <h5 class="my-3">Masukkan Kode Ujian</h5>
                            <form action="#" class="my-3">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="kode_ujian" id="kode_ujian" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="form-group my-4">
                                    <button class="btn btn-primary form-control" id="enrollSubmitButton">Submit</button>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="table-responsive">
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
                        </div> --}}
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <div class="modal fade" id="enrollModal" tabindex="-1" role="dialog" aria-labelledby="enrollModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollModalTitle">Apakah data sudah benar?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="enrollTable">
                    <tr>
                        <th>Nama</th>
                        <td id="enrollNama">asd</td>
                        <th>Pengajar</th>
                        <td id="enrollPengajar">asd</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="enrollStatus">asd</td>
                        <th>Jumlah Soal</th>
                        <td id="enrollJumlahSoal">1</td>
                    </tr>
                    <tr>
                        <th>Jadwal</th>
                        <td id="enrollJadwal">asd</td>
                        <th>Jadwal Selesai</th>
                        <td id="enrollJadwalSelesai">1</td>
                    </tr>
                    <tr>
                        <th>Durasi</th>
                        <td id="enrollDurasi">asd</td>
                        <th>Tanggal Dibuat</th>
                        <td id="enrollTanggalBuat">asd</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="enrollButton" data-id="">Enroll</button>
            </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->  
@endsection