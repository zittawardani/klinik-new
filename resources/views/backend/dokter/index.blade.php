@extends('partials.main')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h3 class="m-0 font-weight-bold " style="color: #58A399;">Data Dokter</h3>
        <button type="submit" class="btn btn-success"><a href="{{ route('dokter.add') }}" class="text-white text-decoration-none">Tambah Data</a></button>
    </div>
    <div class="card-body">
        <!-- Form pencarian dan sorting -->
        <form method="GET" action="{{ route('dokter.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Dokter..." value="{{ $searchTerm ?? '' }}">
                </div>
                <div class="col-md-4">
                    <select name="sort" class="form-control">
                        <option value="nama_dokter" {{ $sortBy == 'nama_dokter' ? 'selected' : '' }}>Sortir Berdasarkan Nama</option>
                        <option value="spesialis" {{ $sortBy == 'spesialis' ? 'selected' : '' }}>Sortir Berdasarkan Spesialis</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Cari & Sortir</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SIP</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th>Jadwal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokter as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data['sip'] }}</td>
                        <td>
                        @if(isset($data['foto_dokter']))
                            <img src="{{ asset('storage/dokter/' . $data['foto_dokter']) }}" alt="Profile {{ $data['nama_dokter'] }}" width="100">
                        @endif
                        </td>
                        <td>{{ $data['nama_dokter'] }}</td>
                        <td>{{ $data['spesialis'] }}</td>
                        <td>
                        @foreach(json_decode($data['jadwal'], true) as $jadwal)
                            {{ $jadwal['hari'] }}, {{ $jadwal['sesi'] }} <br>
                        @endforeach
                        </td>
                        <td>
                        <a href="{{ route('dokter.edit', $data['id']) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('dokter.delete', $data['id']) }}" id="delete" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
