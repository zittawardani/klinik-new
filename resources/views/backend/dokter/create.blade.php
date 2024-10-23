@extends('partials.main')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold" style="color: #58A399;">Tambah Data Dokter</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('dokter.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="foto_dokter">Foto</label>
                <input type="file" class="form-control" id="foto_dokter" name="foto_dokter" accept=".jpg,.png,.jpeg,.gif" required>
            </div>
            <div class="form-group">
                <label for="sip">SIP</label>
                <input type="text" class="form-control" id="sip" name="sip" pattern=".*\S*." placeholder=" " required>
                @error('sip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama_dokter">Nama Dokter</label>
                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" pattern=".*\S*." placeholder=" " required>
                @error('nama_dokter')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-groupp">
                <label for="spesialis" class="form-label">Spesialis</label>
                <select id="spesialis" name="spesialis" class="form-control">
                    <option value="">Pilih Spesialis</option>
                    <option value="Jantung">Jantung</option>
                    <option value="Paru-paru">Paru-paru</option>
                    <option value="Saraf">Saraf</option>
                </select>
            </div>

            @for ($i = 1; $i <= 3; $i++)
                <label>Jadwal {{ $i }}</label>
                <div class="form-group">
                    <label for="hari{{ $i }}" class="form-label">Hari</label>
                    <select id="hari{{ $i }}" name="jadwal[{{ $i - 1 }}][hari]" class="form-control" required>
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sesi{{ $i }}" class="form-label">Sesi</label>
                    <select id="sesi{{ $i }}" name="jadwal[{{ $i - 1 }}][sesi]" class="form-control" required>
                        <option value="">Pilih Sesi</option>
                        <option value="Sesi 1 (09:00-11:00)">Sesi 1 (09:00-11:00)</option>
                        <option value="Sesi 2 (13:00-15:00)">Sesi 2 (13:00-15:00)</option>
                        <option value="Sesi 3 (15:00-17:00)">Sesi 3 (15:00-17:00)</option>
                    </select>
                </div>
            @endfor
            <div class="button mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection