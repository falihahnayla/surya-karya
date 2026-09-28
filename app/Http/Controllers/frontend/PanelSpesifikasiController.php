<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanelSpesifikasiController extends Controller
{
    public function index()
    {
        return view('frontend.spesifikasi-standar');
    }

    public function spesifikasiBangunan()
    {
        return view('frontend.spesifikasi-bangunan');
    }

    public function standarMutu()
    {
        return view('frontend.standar-mutu');
    }
}
