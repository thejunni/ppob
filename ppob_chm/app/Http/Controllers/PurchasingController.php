<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $saldo = $user->balance->balance ?? 0;

        return view('customer.purchasing_phone_credit', compact('saldo', 'user'));
    }
    public function getProdukByProvider($provider)
    {
        $produkList = Produk::where('provider', $provider)
        ->where('kategori', 'PULSA')
        ->orderBy('harga_jual')
        ->get();
    
        return response()->json($produkList);
    }
}
