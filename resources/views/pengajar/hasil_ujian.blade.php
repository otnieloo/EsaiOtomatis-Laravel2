@extends('pengajar/main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hasil Ujian</h1>

        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="container-fluid">

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="topWrap d-flex">
                            <div class="form-group col-3">
                                <label for="ujian">Pilih Ujian</label>
                                <select name="role" id="pilihUjian" class="custom-select mb-3">
                                    <option value=""></option>
                                    @foreach($exam as $a)
                                        <option value="{{$a->id_ujian}}"
                                            @if(isset($examInfo))
                                                @if($a->id_ujian == $examInfo[0]->id_ujian)
                                                    selected
                                                @endif
                                            @endif
                                            >
                                            {{$a->nama}}
                                            @switch($a->status)
                                                @case(1)
                                                    <div class="badge badge-success">(Ongoing)</div>
                                                    @break
                                                @case(2)
                                                    <div class="badge badge-danger">(Ended)</div>
                                                    @break
                                                @default
                                                    <div class="badge badge-warning">(Pending)</div>
                                                    @break
                                            @endswitch
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-data-tab" data-toggle="tab" href="#nav-data" role="tab" aria-controls="nav-data" aria-selected="true">Data</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-data" role="tabpanel" aria-labelledby="nav-data-tab">
                                @if(isset($examInfo))
                                    <div class="table-responsive mt-2" id="hasilUjianTable">
                                        <table class="infoTable">
                                            <tr>
                                                <th>Nama</th>
                                                <td>{{$examInfo[0]->nama}}</td>
                                                <th>Status</th>
                                                <td>
                                                    @switch($examInfo[0]->status)
                                                        @case(1)
                                                            <div class="badge badge-success">Ongoing</div>
                                                            @break
                                                        @case(2)
                                                            <div class="badge badge-danger">Ended</div>
                                                            @break
                                                        @default
                                                            <div class="badge badge-warning">Pending</div>
                                                            <div class="badge badge-info">
                                                                <a href="/edit_ujian/{{$examInfo[0]->id_ujian}}" class="text-white p-1"><i class="fas fa-edit"></i></a>
                                                            </div>
                                                            <div class="badge badge-danger">
                                                                <a href="#" id="deleteBtn" class="deleteBtn text-white p-1"  data-id="{{$examInfo[0]->id_ujian}}" data-nama="{{$examInfo[0]->nama}}"><i class="fas fa-trash-alt"></i></a>
                                                            </div>
                                                            @break
                                                    @endswitch
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Jadwal</th>
                                                <td>{{$examInfo[0]->jadwal}}</td>
                                                <th>Jadwal Selesai</th>
                                                <td>{{$examInfo[0]->jadwal_selesai}}</td>
                                            </tr>
                                            <tr>
                                                <th>Durasi</th>
                                                <td>{{$examInfo[0]->durasi}} menit</td>
                                                <th>Jumlah Soal</th>
                                                <td>{{$examInfo[0]->jumlah_soal}}</td>
                                            </tr>
                                            <tr>
                                                <th>Kode Ujian</th>
                                                <td>{{$examInfo[0]->kode_ujian}}</td>
                                            </tr>
                                        </table>
                                        @if(isset($question))
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Soal</th>
                                                        <th>Jawaban</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($question as $q)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$q->pertanyaan}}</td>
                                                            <td>{{$q->kunci_jawaban}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                
                                            </table>
                                        @endif

                                    </div>
                                @else
                                    <p>No data.</p>                                    
                                @endif

                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                        </div>  
                          
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <!-- /.container-fluid -->  
@endsection