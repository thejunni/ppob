<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use App\Models\TransaksiPulsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

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
        ->where('status', 'aktif')
        ->orderBy('harga_jual')
        ->get();
    
        return response()->json($produkList);
    }
    public function storePulsa(Request $request)
    {
        $request->validate([
            'nomorTujuan' => 'required|min:8',
            'nominal' => 'required|numeric',
            'provider' => 'required|string',
            'namaPaket' => 'required|string',
            'jenisPembayaran' => 'required|in:saldo,transfer,qris',
            'jenisLayanan' => 'required|in:pulsa,paket',
        ]);  

        $user = Auth::user();
        $saldo = json_decode($user->balance->balance) ?? 0;

        $produk = Produk::where('provider', $request->provider)
                        ->where('harga_jual', $request->nominal)
                        ->where('nama', $request->namaPaket)
                        ->first();

        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }
        $harga = $request->nominal;
        $hargaModal = $produk->harga_modal ?? 0;
        $profit = $harga - $hargaModal;

        if ($request->jenisPembayaran === 'saldo' && $saldo < $harga) {
            return back()->with('error', 'Saldo tidak mencukupi.');
        }
        $refId = strtoupper(Str::random(12));
        $username = env('DIGIFLAZZ_USERNAME');
        $apikey = env('DIGIFLAZZ_KEY');
        $signature = md5($username . $apikey . $refId);

        $payload = [
            'username'      => $username,
            'buyer_sku_code'=> $produk->kode,
            'customer_no'   => $request->nomorTujuan,
            'ref_id'        => $refId,
            'sign'          => $signature,
            'testing'       => env('DIGIFLAZZ_TESTING', false),
        ];
        $response = Http::post('https://api.digiflazz.com/v1/transaction', $payload);

        $result = $response->json();
        $status = strtolower($result['data']['status'] ?? 'unknown');
    
        // Validasi status agar tetap aman jika API berubah
        if (!in_array($status, ['pending', 'sukses', 'gagal'])) {
            $status = 'unknown';
        }
    
        // Jika transaksi dikirim dan status valid
        if (in_array($status, ['pending', 'sukses'])) {
            if ($request->jenisPembayaran === 'saldo') {
                $user->balance->decrement('balance', $harga);
            }
    
            TransaksiPulsa::create([
                'user_id'     => $user->id,
                'produk_id'   => $produk->id,
                'nomor'       => $request->nomorTujuan,
                'harga'       => $harga,
                'harga_modal' => $hargaModal,
                'profit'      => $profit,
                'ref_id'      => $refId,
                'status'     => 'sukses',
                'metode'      => $request->jenisPembayaran,
                'layanan'     => $request->jenisLayanan,
            ]);

            return redirect()->route('purchasing-pulsa')->with('success', 'Pembelian sedang diproses.');
        }

        return back()->with('error', 'Transaksi gagal: ' . ($result['data']['message'] ?? 'Tidak diketahui'));
    }
}
