<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SpesifikasiBangunan;
use App\Models\StandarMutu;
use Illuminate\Http\Request;

class PanelSpesifikasiController extends Controller
{
    public function index()
    {
        return view('frontend.spesifikasi-standar');
    }

    public function spesifikasiBangunan()
    {
        $cards = SpesifikasiBangunan::where('item_type', 'card')->get();
        $photos = SpesifikasiBangunan::where('item_type', 'photo')->get();

        return view('frontend.spesifikasi-bangunan', compact('cards', 'photos'));
    }

    public function standarMutu()
    {
        $cards = StandarMutu::where('item_type', 'card')->get();
        $photos = StandarMutu::where('item_type', 'photo')->get();

        return view('frontend.standar-mutu', compact('cards', 'photos'));
    }
}
