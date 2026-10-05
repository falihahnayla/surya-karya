<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('faqs')
            ->orderBy('id')
            ->get();

        return view('frontend.faq', compact('categories'));
    }
}