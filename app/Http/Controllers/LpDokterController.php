<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dokter;

class LpDokterController extends Controller
{
    public function index() {
        $dokter = dokter::all();
        return view('home.app', compact('dokter'));
    }
}
