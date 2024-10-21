@extends('partials.main')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Edit Data Dokter</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('dokter.update', ['id' => $dokter->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="foto_dokter">Foto {{$dokter->foto_dokter}}</label>
                <input type="file" class="form-control" id="foto_dokter" name="foto_dokter" value="{{ old('foto_dokter', $dokter->foto_dokter) }}" accept=".jpg,.png,.jpeg,.gif">
            </div>
            <div class="form-group">
                <label for="sip">SIP</label>
                <input type="text" class="form-control" id="sip" name="sip" value="{{ old('sip', $dokter->sip) }}" pattern=".*\S*." placeholder=" ">
                @error('sip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama_dokter">Nama Dokter</label>
                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="{{ old('nama_dokter', $dokter->nama_dokter) }}" pattern=".*\S*." placeholder=" ">
                @error('nama_dokter')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="spesialis" class="form-label">Spesialis</label>
                <select id="spesialis" name="spesialis" class="form-control">
                    <option value="">Pilih Spesialis</option>
                    <option value="Jantung" {{ $dokter->spesialis == 'Jantung' ? 'selected' : '' }}>Jantung</option>
                    <option value="Paru-paru" {{ $dokter->spesialis == 'Paru-paru' ? 'selected' : '' }}>Paru-paru</option>
                    <option value="Saraf" {{ $dokter->spesialis == 'Saraf' ? 'selected' : '' }}>Saraf</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hari" class="form-label">Hari</label>
                <select id="hari" name="hari" class="form-control">
                    <option value="">Pilih Hari</option>
                    <option value="Senin" {{ $dokter->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ $dokter->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ $dokter->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ $dokter->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ $dokter->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sesi" class="form-label">Sesi</label>
                <textarea class="form-control" placeholder="Leave a comment here" name="sesi" id="floatingTextarea2" style="height: 100px">{{ old('sesi', $dokter->sesi) }}</textarea>
                <!-- <select id="sesi" name="sesi" class="form-control">
                    <option value="">Pilih Sesi</option>
                    <option value="Sesi 1 (09:00-11:00)" {{ $dokter->sesi == 'Sesi 1 (09:00-11:00)' ? 'selected' : '' }}>Sesi 1 (09:00-11:00)</option>
                    <option value="Sesi 2 (13:00-15:00)" {{ $dokter->sesi == 'Sesi 2 (13:00-15:00)' ? 'selected' : '' }}>Sesi 2 (13:00-15:00)</option>
                    <option value="Sesi 3 (15:00-17:00)" {{ $dokter->sesi == 'Sesi 3 (15:00-17:00)' ? 'selected' : '' }}>Sesi 3 (15:00-17:00)</option>
                </select> -->
            </div>
            <div class="button mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection