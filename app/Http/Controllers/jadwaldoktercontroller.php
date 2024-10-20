<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class jadwaldoktercontroller extends Controller
{
    // menampilkan ke halaman index yang berbentuk tabel
    public function index() {
        $dokter = jadwaldokter::all();
        return view('backend.jadwaldokter.index',[
            'title' => 'Jadwal Dokter',
            'jadwaldokter' => $jadwaldokter,
        ]);
    }

    public function create() {
        return view('backend.dokter.create', [
            'title' => 'Tambah Jadwal Dokter'
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'jadwal_id' => 'required|string',
            'dokter_id' => 'requied|string',
            'sesi' => 'required|string',
            'status' => 'required|string'
        ]);

        $jadwaldokter = new JadwalDokter();
        $jadwaldokter->jadwal_id= $validateData['jadwal_id'];
        $jadwaldokter->dokter_id= $validateData['dokter_id'];
        $jadwaldokter->sesi= $validateData['sesi'];
        $jadwaldokter->status = $validateData['status'];
        $jadwaldokter->save();

        return redirect()->route('jadwaldokter.index')->with('success', 'Data berhasil ditambahkan');
    }
}
