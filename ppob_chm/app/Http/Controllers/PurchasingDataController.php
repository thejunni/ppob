<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Http;

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

    public function storePaket(Request $request)
    {
        $request->validate([
            'nomorTujuan' => 'required|min:8',
            'nominal' => 'required|numeric',
            'provider' => 'required|string',
            'namaPaket' => 'required|string',
            'jenisPembayaran' => 'required|in:saldo,transfer,qris',
        ]);
    
        $user = $request->user();
        $saldo = $user->balance->saldo ?? 0;
        $harga = $request->nominal;
    
        if ($request->jenisPembayaran === 'saldo' && $saldo < $harga) {
            return back()->with('error', 'Saldo tidak mencukupi.');
        }
    
        // Ambil produk berdasarkan nama atau harga
        $produk = \App\Models\Produk::where('provider', $request->provider)
            ->where('harga_jual', $harga)
            ->where('nama', $request->namaPaket)
            ->first();
    
        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }
    
        // 🔐 Kunci API Digiflazz
        $username = env('DIGIFLAZZ_USERNAME');
        $apiKey   = env('DIGIFLAZZ_API_KEY');
    
        // 🔐 Generate signature
        $refId = 'CHM-' . time();
        $signature = md5($username . $apiKey . $refId);
    
        // 🔧 Buat payload terlebih dahulu
        $payload = [
            'username'      => $username,
            'buyer_sku_code'=> $produk->kode,
            'customer_no'   => $request->nomorTujuan,
            'ref_id'        => $refId,
            'sign'          => $signature,
            'testing'       => env('DIGIFLAZZ_TESTING', false), // true = sandbox, false = live
        ];

        // 🔗 Kirim ke DIGIFLAZZ
        dd($payload);
        $response = Http::post('https://api.digiflazz.com/v1/transaction', $payload);
    
        $result = $response->json();
    
        // ✅ Simpan log atau transaksi jika berhasil
        if ($result['data']['status'] === 'Pending') {
            // Kurangi saldo jika pakai metode saldo
            if ($request->jenisPembayaran === 'saldo') {
                $user->balance->decrement('saldo', $harga);
            }
        
            // Simpan ke tabel transaksi kamu
            \App\Models\TransaksiPulsa::create([
                'user_id' => $user->id,
                'produk_id' => $produk->id,
                'nomor' => $request->nomorTujuan,
                'harga' => $harga,
                'ref_id' => $refId,
                'status' => 'pending',
                'metode' => $request->jenisPembayaran,
            ]);
        
            return redirect()->route('pembelian.pulsa')->with('success', 'Pembelian sedang diproses.');
        }
    
        return back()->with('error', 'Gagal melakukan pembelian: ' . $result['data']['message']);
    }

}
