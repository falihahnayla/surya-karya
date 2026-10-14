<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\Setting;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('faqs')
            ->orderBy('id')
            ->get();

        $setting = Setting::first();

        return view('frontend.faq', compact('categories', 'setting'));
    }
}