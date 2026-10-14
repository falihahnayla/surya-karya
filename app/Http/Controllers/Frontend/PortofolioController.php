<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use App\Models\PortofolioCategory;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $categories = PortofolioCategory::orderBy('title', 'asc')->get();
        $portofolios = Portofolio::with('category')
            ->where('status', 'Show')
            ->latest()
            ->get();

        return view('frontend.portofolio', compact('categories', 'portofolios'));
    }
}
