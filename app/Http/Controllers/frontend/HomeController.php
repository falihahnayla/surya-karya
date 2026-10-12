<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\Service;
use App\Models\Setting;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data beranda: pakai data terbaru, kalau kosong pakai objek kosong (blade punya nilai default)
        $home = Home::latest()->first() ?? new Home();

        // Urutan input di backoffice: data pertama = Visi, data kedua = Misi
        $visiMisi = VisiMisi::orderBy('id')->get();
        $visi = $visiMisi->get(0);
        $misi = $visiMisi->get(1);

        // Kartu "Standar Eksekusi Terbaik"
        $services = Service::orderBy('id')->get();

        // Data profil perusahaan dari tabel settings
        $setting = Setting::first();

        return view('frontend.home', compact('home', 'visi', 'misi', 'services', 'setting'));
    }
}