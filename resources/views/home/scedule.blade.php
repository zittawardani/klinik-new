<div class="container-fluid" style="background-color: #EEEEEE; padding: 100px;">
    <h2 class="text-center mb-4" style="color: #58A399;">Jadwal Praktek Dokter</h2>
    <p class="text-center mb-5">Atur janji temu Anda dengan dokter kami secara online untuk konsultasi
        dan perawatan yang sesuai dengan kebutuhan kesehatan Anda.</p>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($dokter as $dokter)
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/dokter/'.$dokter->foto_dokter) }}" class="rounded-circle mb-3" alt="Doctor Image" width="100" height="100">
                        <h5 class="card-title fw-bold">{{ $dokter->nama_dokter }}</h5>
                        <p class="card-text">{{ $dokter->spesialis }}</p>
                        <!-- Display sessions vertically -->
                        <div class="card-text">
                            @foreach(json_decode($dokter->jadwal, true) as $jadwal)
                            {{ $jadwal['hari'] }}, {{ $jadwal['sesi'] }} <br>
                            @endforeach
                        </div>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-success" style="background-color: #58A399;" 
                                data-bs-toggle="modal" data-bs-target="#konsultasiModal"
                                data-nama="{{ $dokter->nama_dokter }}" data-spesialis="{{ $dokter->spesialis }}">
                            Daftar Konsultasi
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="konsultasiModal" tabindex="-1" aria-labelledby="konsultasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konsultasiModalLabel">Pengajuan Konsultasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="konsultasiForm">
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan nama sesuai KTP" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No Hp / WhatsApp</label>
                        <input type="text" class="form-control" id="no_hp" placeholder="Masukkan no Hp / WhatsApp" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" required>
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" required>
                        </div>
                        <div class="col">
                            <label for="golongan_darah" class="form-label">Golongan Darah</label>
                            <select class="form-select" id="golongan_darah" required>
                                <option selected disabled>Pilih Golongan Darah</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h5>Dokter</h5>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="spesialis" class="form-label">Spesialis</label>
                            <input type="text" class="form-control" id="spesialis" readonly>
                        </div>
                        <div class="col">
                            <label for="dokter" class="form-label">Dokter</label>
                            <input type="text" class="form-control" id="dokter" readonly>
                        </div>
                        <div class="col">
                            <label for="jadwal" class="form-label">Jadwal</label>
                            <select class="form-select" id="jadwal" required>
                                <option selected disabled>Pilih Jadwal</option>
                                @foreach(json_decode($dokter->jadwal, true) as $index => $jadwal)
                                <option value="{{ $jadwal['hari'] }}, {{ $jadwal['sesi'] }}">{{ $jadwal['hari'] }} {{ $jadwal['sesi'] }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="kirimKonsultasi">Kirim Konsultasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Mengisi data modal ketika tombol Daftar Konsultasi diklik
    var konsultasiModal = document.getElementById('konsultasiModal');
    konsultasiModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var namaDokter = button.getAttribute('data-nama');
        var spesialisDokter = button.getAttribute('data-spesialis');
        
        // Set nilai pada input form modal
        var modalNamaDokter = konsultasiModal.querySelector('#dokter');
        var modalSpesialis = konsultasiModal.querySelector('#spesialis');
        
        modalNamaDokter.value = namaDokter;
        modalSpesialis.value = spesialisDokter;
    });

    document.getElementById('konsultasiForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const nik = document.getElementById('nik').value;
        const nama = document.getElementById('nama').value;
        const alamat = document.getElementById('alamat').value;
        const no_hp = document.getElementById('no_hp').value;
        const jenis_kelamin = document.getElementById('jenis_kelamin').value;
        const tanggal_lahir = document.getElementById('tanggal_lahir').value;
        const golongan_darah = document.getElementById('golongan_darah').value;
        const spesialis = document.getElementById('spesialis').value;
        const dokter = document.getElementById('dokter').value;
        const jadwal = document.getElementById('jadwal').value;

        const message = `Halo, saya ingin melakukan konsultasi.\nNIK: ${nik}\nNama: ${nama}\nAlamat: ${alamat}\nNo HP: ${no_hp}\nJenis Kelamin: ${jenis_kelamin}\nTanggal Lahir: ${tanggal_lahir}\nGolongan Darah: ${golongan_darah}\nSpesialis: ${spesialis}\nDokter: ${dokter}\nJadwal: ${jadwal}`;
        const encodedMessage = encodeURIComponent(message);
        const phoneNumber = no_hp.replace(/[^0-9]/g, '');

        window.open(`https://wa.me/+6283847663334?text=${encodedMessage}`, '_blank');
    });
</script>
