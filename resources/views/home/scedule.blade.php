
    <div class="container my-5">
        <h2 class="text-center mb-4">Jadwal Praktek Dokter</h2>
        <p class="text-center mb-5">Lorem ipsum dolor sit amet consectetur. Ullamcorper vulputate non in lorem adipiscing tempor integer blandit commodo.</p>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
           @foreach($dokter as $dokter)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/dokter/'.$dokter->foto_dokter) }}" class="rounded-circle mb-3" alt="Doctor Image" width="100" height="100">
                            <h5 class="card-title">{{ $dokter->nama_dokter }}</h5>
                            <p class="card-text">{{ $dokter->spesialis }}</p>
                            <p class="card-text">
                               {{$dokter->sesi}}
                            </p>
                            <a href="#" class="btn btn-success">Daftar Konsultasi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

