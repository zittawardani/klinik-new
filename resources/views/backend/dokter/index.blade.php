@extends('partials.main')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h3 class="m-0 font-weight-bold text-primary">Data Dokter</h3>
        <button type="submit" class="btn btn-success"><a href="{{ route('dokter.add') }}" class="text-white text-decoration-none">Tambah Data</a></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SIP</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokter as $key => $dokter)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $dokter->sip }}</td>
                        <td>
                        @if($dokter->foto_dokter)
                            <img src="{{ asset('storage/dokter/' . $dokter->foto_dokter) }}" alt="Profile {{ $dokter->nama_dokter }}" width="100">
                        @endif
                        </td>
                        <td>{{ $dokter->nama_dokter}}</td>
                        <td>{{ $dokter->spesialis }}</td>
                        <td>
                        <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('dokter.delete', $dokter->id) }}" id= "delete" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection