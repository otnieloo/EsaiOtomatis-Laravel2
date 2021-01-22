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
                              <a class="nav-item nav-link" id="nav-enroll-tab" data-toggle="tab" href="#nav-enroll" role="tab" aria-controls="nav-enroll" aria-selected="false">Enroll</a>
                              <a class="nav-item nav-link" id="nav-nilai-tab" data-toggle="tab" href="#nav-nilai" role="tab" aria-controls="nav-nilai" aria-selected="false">Nilai</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            {{-- Data --}}
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
                                                <th>Export</th>
                                                <th><a href="/export/{{$examInfo[0]->id_ujian}}"><i class="far fa-file-excel fa-2x" style="color:#2ab12e;"></i></a></th>
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
                            {{-- Enroll --}}
                            <div class="tab-pane fade" id="nav-enroll" role="tabpanel" aria-labelledby="nav-enroll-tab">
                                @if(isset($enroll))
                                    <div class="table-responsive mt-2" id="hasilUjianTable">
                                        <table class="infoTable">
                                            <tr>
                                                <th>Jumlah siswa enrolled</th>
                                                <td>{{count($enroll)}} siswa</td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered display nowrap" id="dataTable3" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Waktu Enroll</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($enroll as $e)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$e->nama}}</td>
                                                        <td>{{$e->email}}</td>
                                                        <td>{{$e->date_enrolled}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            
                                        </table>

                                    </div>
                                @else
                                    <p>No data.</p>                                    
                                @endif
                            </div>
                            {{-- Nilai --}}
                            <div class="tab-pane fade" id="nav-nilai" role="tabpanel" aria-labelledby="nav-nilai-tab">
                                @if(isset($enroll))
                                    @if(count($enroll)!=0)
                                    
                                        <div class="table-responsive mt-2" id="hasilUjianTable">
                                            <table class="infoTable">
                                                <tr>
                                                    <th>Jumlah siswa submitted</th>
                                                    <td>{{count($answer)}} siswa</td>
                                                </tr>
                                            </table>
                                            <table class="table table-bordered display nowrap" id="dataTable4" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                        <th>Waktu Submit</th>
                                                        <th>Total Nilai</th>
                                                        <th>Total NilaiQE</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($enroll as $e)
                                                        @if (isset($answer[$loop->iteration-1][0]))
                                                            <tr data-child-value="{{$e}}" data-child-value2="{{$loop->iteration}}" data-child-value3="{{$answer[$loop->iteration-1]}}">
                                                                <td class="details-control"></td>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$e->nama}}</td>
                                                                <td>{{$e->email}}</td>
                                                                <td>
                                                                    @if($examInfo[0]->jadwal_selesai >= $answer[$loop->iteration-1][0]->created_at)
                                                                        <div class="badge badge-success">
                                                                            On time
                                                                        </div>
                                                                    @else
                                                                    <div class="badge badge-danger">
                                                                        Late
                                                                        @php 
                                                                            $origin = new DateTime($answer[$loop->iteration-1][0]->created_at);
                                                                            $target = new DateTime($examInfo[0]->jadwal_selesai);
                                                                            $interval = $origin->diff($target);
                                                                            echo $interval->format('%R%i minutes');
                                                                        @endphp
                                                                    </div>
                                                                    @endif
                                                                </td>
                                                                <td>{{$answer[$loop->iteration-1][0]->created_at}}</td>
                                                                <td>{{$score[$loop->iteration-1]->total_nilai}}</td>
                                                                <td>{{$score[$loop->iteration-1]->total_nilaiqe}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                                
                                            </table>

                                        </div>
                                    @else
                                        <p>No data.</p>                                    
                                    @endif
                                @endif
                            </div>
                        </div>  
                          
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded',()=>{
            /* Formatting function for row details - modify as you need */
            
            function format2(d,d2,d3) {
                // `d` is the original data object for the row
                var table =  '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                    '<tr>'+
                        '<th>No</th>'+
                        '<th>Jawaban</th>'+
                        '<th>Cosine Sim</th>'+
                        '<th>Cosine Sim+QE</th>'+
                        '<th>Nilai Sistem</th>'+
                        '<th>Total Konversi</th>'+
                        '<th>Total Konversi QE</th>'+
                    '</tr>';
                var count = 1;
                
                for(var x = 0;x<d3.length;x++){
                     table += '<tr>'+
                        '<td>'+count+'</td>'+
                        '<td>'+d3[x]['jawaban']+'</td>'+
                        '<td>'+d3[x]['nilai_similaritas']+'</td>'+
                        '<td>'+d3[x]['nilai_similaritasqe']+'</td>'+
                        '<td>'+d3[x]['nilai_sistem']+'</td>'+
                        '<td>'+d3[x]['nilai_konversi']+'</td>'+
                        '<td>'+d3[x]['nilai_konversiqe']+'</td>'+
                        '</tr>';
                    count++;
                }
                 table += '</table>';

                return table;
            }
            var table = $('#dataTable3').DataTable({});
            var table = $('#dataTable4').DataTable({});
            $(document).on('click',function(e){
                console.log(e.target);
            });

            // Add event listener for opening and closing details
            $('#dataTable4').on('click','td.details-control', function () {
                console.log('Clicked');
                var tr = $(this).closest('tr');
                var row = table.row( tr );
        
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format2(tr.data('child-value'),tr.data('child-value2'),tr.data('child-value3'))).show();
                    tr.addClass('shown');
                }
            } );
             
        })
    </script>
    <!-- /.container-fluid -->  
@endsection