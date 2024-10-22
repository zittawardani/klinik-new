
    <div class="container my-5">
        <h2 class="text-center mb-4" style="color: #58A399;">Jadwal Praktek Dokter</h2>
        <p class="text-center mb-5">Atur janji temu Anda dengan dokter kami secara online untuk konsultasi
        dan perawatan yang sesuai dengan kebutuhan kesehatan Anda.</p>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
           @foreach($dokter as $dokter)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/dokter/'.$dokter->foto_dokter) }}" class="rounded-circle mb-3" alt="Doctor Image" width="100" height="100">
                            <h5 class="card-title fw-bold" >{{ $dokter->nama_dokter }}</h5>
                            <p class="card-text">{{ $dokter->spesialis }}</p>
                            <p class="card-text">
                               {{$dokter->sesi}}
                            </p>
                            <a href="#" class="btn btn-success" style="background-color: #58A399;">Daftar Konsultasi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

