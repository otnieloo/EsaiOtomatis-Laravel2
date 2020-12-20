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
                        <form>
                            <div class="form-group col-3">
                                <label for="nama">Nama Ujian</label>
                                <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="" name="nama">
                            </div>
                            <div class="form-group col-3">
                                <label for="jadwal">Jadwal</label>
                                <input size="16" type="text" readonly class="form-control form_datetime" name="jadwal">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <!-- /.container-fluid -->  
@endsection