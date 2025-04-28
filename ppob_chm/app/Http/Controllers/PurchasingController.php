<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchasingController extends Controller
{
    public function index()
    {
        return view('purchasing_page');
    }
}
