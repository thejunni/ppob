<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasingDataController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $saldo = $user->balance->balance ?? 0;
        return view('customer.purchasing_mobile_data',compact('saldo', 'user'));

    }
    public function getProdukByProvider($provider)
    {
        $produkList = Produk::where('provider', $provider)
        ->where('kategori', 'DATA')
        ->orderBy('harga_jual')
        ->get();
    
        return response()->json($produkList);
    }
}
