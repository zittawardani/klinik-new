<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dokter;
use Illuminate\Support\Facades\Storage;

class doktercontroller extends Controller
{
    // menampilkan ke halaman index yang berbentuk tabel
    public function index() {
        $dokter = dokter::all();
        return view('backend.dokter.index',[
            'title' => 'Dokter',
            'dokter' => $dokter,
        ]);
    }

    public function create() {
        return view('backend.dokter.create', [
            'title' => 'Tambah Dokter'
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'sip' => 'required|string',
            'foto_dokter' => 'required|image|mimes:jpeg,jpg,png,gif|max:5120',
            'nama_dokter' => 'required|string',
            'spesialis' => 'required|string',
            'hari' => 'required|string',
            'sesi' => 'required|string',

        ]);

        // Upload File
        if ($request->hasFile('foto_dokter')) {
            $image = $request->file('foto_dokter');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('dokter', $imageName, 'public');
            $validateData['foto_dokter'] = $imageName;
        }

        $dokter = new Dokter();
        $dokter->sip= $validateData['sip'];
        $dokter->nama_dokter= $validateData['nama_dokter'];
        $dokter->spesialis= $validateData['spesialis'];
        $dokter->hari= $validateData['hari'];
        $dokter->sesi= $validateData['sesi'];
        $dokter->foto_dokter = $imageName;
        $dokter->save();

        return redirect()->route('dokter.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id) {
        $dokter = dokter::find($id);
        return view('backend.dokter.edit', [
            'title' => 'Edit Data Dokter',
            'dokter' => $dokter,
        ]);
    }

    public function update(Request $request, $id) {
        $validateData = $request->validate([
            'sip' => 'nullable|string',
            'foto_dokter' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'nama_dokter' => 'nullable|string',
            'spesialis' => 'nullable|string',
            'hari'=> 'nullable|string',
            'sesi' => 'nullable|string',
        ]);
        
        $dokter = dokter::find($id);
        
        if ($request->hasFile('foto_dokter')) {
            $imagePath = storage_path('app/public/dokter/' . $dokter->foto_dokter);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            $image = $request->file('foto_dokter');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('dokter', $imageName, 'public');
            $validateData['foto_dokter'] = $imageName;
        }

        $dokter->sip= $validateData['sip']  ?? $dokter->sip;
        $dokter->nama_dokter= $validateData['nama_dokter'] ?? $dokter->nama_dokter;
        $dokter->spesialis= $validateData['spesialis'] ?? $dokter->spesialis;
        $dokter->hari= $validateData['hari'] ?? $dokter->hari;
        $dokter->sesi= $validateData['sesi'] ?? $dokter->sesi;

        if(isset($validateData['foto_dokter'])){
            $dokter->foto_dokter = $validateData['foto_dokter'];
        }
        

        $dokter->save();

        return redirect()->route('dokter.index')->with('success', 'Data berhasil di update');
    }

    public function delete($id) {
        $dokter = dokter::find($id);
        Storage::delete('public/dokter/' . $dokter->foto_dokter);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data berhasil di delete');
    }
}
