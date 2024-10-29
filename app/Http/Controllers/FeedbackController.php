<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\feedback;
use App\Models\Dokter;

class FeedbackController extends Controller
{
    public function create() {
        $dokter = Dokter::all();
        return view("home.feedback", compact("dokter"));
    }

    public function store(Request $request) {
        $request->validate([
            'id_dokter' => 'required|exists:dokters,id',
            'nik' => 'required|integer',
            'nama_pasien'=> 'required|string',
            'komentar' => 'required|string',
        ]);

        Feedback::create([
            'id_dokter' => $request->id_dokter,
            'nik' => $request->nik,
            'nama_pasien' => $request->nama_pasien,
            'komentar' => $request->komentar,
        ]);
        return redirect('/')->with('success','data berhasil dikirim');
    }
}
