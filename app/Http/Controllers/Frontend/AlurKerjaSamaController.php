<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AlurKerja;

class AlurKerjaSamaController extends Controller
{
    public function index()
    {
        $items = AlurKerja::orderBy('no')->get();

        return view('frontend.alur-kerja', compact('items'));
    }
}