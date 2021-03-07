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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($status == 'late')
                            <div class="alert alert-danger">
                                You are late. Your submission status will be late.
                            </div>
                        @endif
                        <h1 class="h3 mb-2 text-gray-800 text-center">Soal Ujian {{$ujian->nama}}</h1>
                        <hr>
                        <h5 class="text-right" id="timerCountdown"></h5>
                        <form action="/isi_ujian" method="post" class="isiUjian" id="isiUjian">
                            {{ csrf_field()}}
                            <input type="hidden" name="id" value="{{$id_hash}}">
                            <table class="table">
                                @foreach($question as $q)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <th>Pertanyaan</th>
                                        <th>{{$q->pertanyaan}}</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th>Jawaban</th>
                                        <td>
                                            <textarea name="jawaban[]" id="" cols="80" rows="5"></textarea>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-primary mx-auto w-25 btnIsiUjian">Submit</button>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded',()=>{
            // Timer
            // Set the date we're counting down to
            var countDownDate = new Date('{{ $ujian->jadwal_selesai }}').getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                @if($status == 'late')
                    document.getElementById("timerCountdown").innerText = "Sisa waktu: LATE";
                @else
                    document.getElementById("timerCountdown").innerText = "Sisa waktu: "+days + "hari " + hours + "jam "
                    + minutes + "menit " + seconds + "detik ";                    
                @endif
                // document.getElementById("timerCountdown").innerText = "Sisa waktu: "+days + "hari " + hours + "jam "
                // + minutes + "menit " + seconds + "detik ";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);

            $('.btnIsiUjian').on('click',function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Anda yakin? Cek kembali jawaban anda dan pastikan tidak ada kesalahan penulisan (Typo) karena akan mempengaruhi hasil.',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Yakin`,
                    denyButtonText: `Belum Yakin`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('.isiUjian').submit();
                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            })

        });
    </script>
    <!-- /.container-fluid -->  
@endsection