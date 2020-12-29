@extends('siswa/main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Isi Soal Ujian</h1>
        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="container-fluid">


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h1 class="h3 mb-2 text-gray-800 text-center">Soal Ujian XXX</h1>
                        <hr>
                        <h5 class="text-right" id="timerCountdown"></h5>
                        <table class="table">
                            @for($i = 1; $i<=5;$i++)
                                <tr>
                                    <th>{{$i}}</th>
                                    <th>Pertanyaan</th>
                                    <th>Apa yang dimaksud XXX?</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th>Jawaban</th>
                                    <td>
                                        <textarea name="jawaban[]" id="" cols="80" rows="5"></textarea>
                                    </td>
                                </tr>
                            @endfor
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-primary mx-auto w-25">Submit</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <!-- /.container-fluid -->  
@endsection