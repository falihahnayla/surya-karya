<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pembangunan;
use App\Models\Renovasi;
use Illuminate\Http\Request;

class PanelPembangunanController extends Controller
{
    public function index()
    {
        return view('frontend.pembangunan-renovasi');
    }

    public function pembangunan()
    {
        $cards = Pembangunan::where('item_type', 'card')->get();
        $photos = Pembangunan::where('item_type', 'photo')->get();

        return view('frontend.pembangunan', compact('cards', 'photos'));
    }

    public function renovasi()
    {
        $cards = Renovasi::where('item_type', 'card')->get();
        $photos = Renovasi::where('item_type', 'photo')->get();

        return view('frontend.renovasi', compact('cards', 'photos'));
    }
}
