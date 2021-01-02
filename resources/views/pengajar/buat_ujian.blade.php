@extends('pengajar/main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Buat Ujian</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="post" action="/buat_ujian">
                            {{csrf_field()}}
                            <div class="topWrap d-flex">
                                <div class="form-group col-3">
                                    <label for="nama">Nama Ujian</label>
                                    <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="" name="nama" value="{{old('nama')}}">
                                </div>
                                <div class="form-group col-3">
                                    <label for="jadwal">Jadwal</label>
                                    <input size="16" type="text" readonly class="form-control form_datetime" name="jadwal" value="{{old('jadwal')}}">
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <h2>Buat Soal dan Kunci Jawaban</h2>
                                @if(old('soal', null) != null)
                                    @foreach(old('soal') as $s)
                                        @if($s != '' && old('jawaban.'.(($loop->iteration)-1)) != '')
                                            <div class="fieldwrapper form-group d-flex flex-column" id="field">
                                                <label for="soal">Soal</label>
                                                <input id="soal" type="text" class="form-control fieldname col-6" name="soal[]" value="{{$s}}" />
                                                <label for="jawaban">Jawaban</label>
                                                <textarea id="jawaban" class="form-control fieldname col-7" rows="6" name="jawaban[]" >{{old('jawaban.'.(($loop->iteration)-1))}}</textarea>
                                            </div>
                                        @elseif($s != '' && old('jawaban.'.(($loop->iteration)-1)) == '')
                                            <div class="fieldwrapper form-group d-flex flex-column" id="field">
                                                <label for="soal">Soal</label>
                                                <input id="soal" type="text" class="form-control fieldname col-6" name="soal[]" value="{{$s}}" />
                                                <label for="jawaban">Jawaban</label>
                                                <textarea id="jawaban" class="form-control fieldname col-7" rows="6" name="jawaban[]" ></textarea>
                                            </div>
                                        @elseif($s == '' && old('jawaban.'.(($loop->iteration)-1)) != '')
                                            <div class="fieldwrapper form-group d-flex flex-column" id="field">
                                                <label for="soal">Soal</label>
                                                <input id="soal" type="text" class="form-control fieldname col-6" name="soal[]" value="{{$s}}" />
                                                <label for="jawaban">Jawaban</label>
                                                <textarea id="jawaban" class="form-control fieldname col-7" rows="6" name="jawaban[]" >{{old('jawaban.'.(($loop->iteration)-1))}}</textarea>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="fieldwrapper form-group d-flex flex-column" id="field">
                                        <label for="soal">Soal</label>
                                        <input id="soal" type="text" class="form-control fieldname col-6" name="soal[]" />
                                        <label for="jawaban">Jawaban</label>
                                        <textarea id="jawaban" class="form-control fieldname col-7" rows="6" name="jawaban[]" ></textarea>
                                    </div>
                                @endif
    

                                <fieldset id="buildyourform">
                                    {{-- <legend>Tambahkan Soal</legend> --}}
                                </fieldset>
                                <button type="button" value="Add a field" class="btn btn-success add" id="add">Tambah Soal</button>
                            </div>
                            

                            
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Preview-->
    <div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="modalPreviewTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPreviewTitle">Apakah data sudah benar?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Field</th>
                        <th scope="col">Isi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
  
    <!-- /.container-fluid -->  
@endsection