<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormPesanController extends Controller
{
    public function index()
    {
        return view('frontend.form-pemesanan');
    }
}
