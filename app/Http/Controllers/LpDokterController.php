<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class LpDokterController extends Controller
{
    public function index() {
        $dokter = Dokter::all(); //mengambil data dari database / table dokter
        return view('home.app', compact('dokter')); //mengambil data dari table dokter untuk ditampilkan ke home
    }
}
