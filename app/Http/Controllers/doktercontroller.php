<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class doktercontroller extends Controller
{
    public function admin() {
        return view('dashboard');
    }

    // menampilkan ke halaman index yang berbentuk tabel
    public function index(Request $request) {
        // Data dokter diambil dari database
        $dokterList = Dokter::all()->toArray(); // Mengubah ke array untuk algoritma manual
    
        // Mendapatkan nilai pencarian dan pengurutan dari request
        $searchTerm = $request->input('search', ''); //searching
        $sortBy = $request->input('sort', 'nama_dokter'); // Default sorting by nama_dokter
    
        // Algoritma Linear Search untuk filtering
        $filteredDokter = [];
        foreach ($dokterList as $dokter) {
            if (stripos($dokter['nama_dokter'], $searchTerm) !== false) { // Pencarian case-insensitive
                $filteredDokter[] = $dokter;
            }
        }
    
        // Algoritma Bubble Sort untuk sorting
        $n = count($filteredDokter);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($filteredDokter[$j][$sortBy] > $filteredDokter[$j + 1][$sortBy]) {
                    // Tukar posisi jika tidak dalam urutan yang benar
                    $temp = $filteredDokter[$j];
                    $filteredDokter[$j] = $filteredDokter[$j + 1];
                    $filteredDokter[$j + 1] = $temp;
                }
            }
        }
    
        // Kirim data ke view
        return view('backend.dokter.index', [
            'title' => 'Dokter',
            'dokter' => $filteredDokter, // Data hasil pencarian dan pengurutan
            'searchTerm' => $searchTerm,
            'sortBy' => $sortBy,
        ]);
    }    

    public function create() {
        return view('backend.dokter.create', [
            'title' => 'Tambah Dokter'
        ]);
    }

    // proses create data
    public function store(Request $request) {
        $validateData = $request->validate([
            'sip' => 'required|string',
            'foto_dokter' => 'required|image|mimes:jpeg,jpg,png,gif|max:5120',
            'nama_dokter' => 'required|string',
            'spesialis' => 'required|string',
            'jadwal' => 'required|array',
            'jadwal.*.hari' => 'required|string',
            'jadwal.*.sesi' => 'required|string',
        ]);

        // Upload File image
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
        $dokter->jadwal = json_encode($request->jadwal);
        $dokter->foto_dokter = $imageName;
        $dokter->save(); // menyimpan kedalam database

        Log::info('Dokter created: ', [
            'sip' => $dokter->sip,
            'nama_dokter' => $dokter->nama_dokter,
            'spesialis' => $dokter->spesialis,
            'jadwal' => $dokter->jadwal,
            'foto_dokter' => $dokter->foto_dokter,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data berhasil ditambahkan');
    } 


    // proses untuk edit data
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
            'jadwal' => 'required|array',
            'jadwal.*.hari' => 'required|string',
            'jadwal.*.sesi' => 'required|string',
        ]);
        
        $dokter = dokter::find($id); //mencari dan mengambil data dokter berdasarkan id
        
        if ($request->hasFile('foto_dokter')) {
            $imagePath = storage_path('app/public/dokter/' . $dokter->foto_dokter); //foto disimpan pada public

            if (file_exists($imagePath)) {
                unlink($imagePath); // menghapus gambar lama
            }
            
            //mengupload gambar baru
            $image = $request->file('foto_dokter');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('dokter', $imageName, 'public');
            $validateData['foto_dokter'] = $imageName;
        }

        // proses update data
        $dokter->sip= $validateData['sip']  ?? $dokter->sip;
        $dokter->nama_dokter= $validateData['nama_dokter'] ?? $dokter->nama_dokter;
        $dokter->spesialis= $validateData['spesialis'] ?? $dokter->spesialis;
        $dokter->jadwal = json_encode($request->jadwal);

        if(isset($validateData['foto_dokter'])){
            $dokter->foto_dokter = $validateData['foto_dokter'];
        }
        
        $dokter->save();

        Log::info('Dokter updated: ', [
            'id' => $dokter->id,
            'sip' => $dokter->sip,
            'nama_dokter' => $dokter->nama_dokter,
            'spesialis' => $dokter->spesialis,
            'jadwal' => $dokter->jadwal,
            'foto_dokter' => $dokter->foto_dokter,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data berhasil di update');
    }

    // fungsi untuk delete data
    public function delete($id) {
        $dokter = dokter::find($id);
        Storage::delete('public/dokter/' . $dokter->foto_dokter); //menghapus gambar di storage
        $dokter->delete();

        Log::info('Dokter deleted: ', [
            'id' => $dokter->id,
            'sip' => $dokter->sip,
            'nama_dokter' => $dokter->nama_dokter,
            'spesialis' => $dokter->spesialis,
            'jadwal' => $dokter->jadwal,
            'foto_dokter' => $dokter->foto_dokter,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Data berhasil di delete');
    }
}
