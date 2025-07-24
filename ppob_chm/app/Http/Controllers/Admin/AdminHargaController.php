<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Provider;
use App\Services\DigiFlazzService;
use Illuminate\Support\Facades\Http;

class AdminHargaController extends Controller
{
    protected $digiflazz;

    public function __construct(DigiFlazzService $digiflazz)
    {
        $this->digiflazz = $digiflazz;
    }
    public function index(Request $request)
    {
        $username = env('DIGIFLAZZ_USERNAME');
        $apiKey   = env('DIGIFLAZZ_KEY');
        $signature = md5($username . $apiKey . 'depo');
    
        // Ambil saldo dari API Digiflazz
        $payload = [
            'cmd' => 'deposit',
            'username' => $username,
            'sign' => $signature,
        ];
    
        $isTesting = env('DIGIFLAZZ_TESTING', false);
        $response = $isTesting
            ? Http::withoutVerifying()->post('https://api.digiflazz.com/v1/cek-saldo', $payload)
            : Http::post('https://api.digiflazz.com/v1/cek-saldo', $payload);
            
        $resultAPI = $response->json();
        $totalSaldo = $resultAPI['data']['deposit'] ?? 0;
    
        // Ambil daftar produk dan lakukan pencarian jika ada keyword
        $query = Produk::query();
    
        if ($request->has('cari') && $request->cari !== null) {
            $search = $request->cari;
            $query->where('kode', 'like', "%{$search}%")
                  ->orWhere('provider', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
        }
    
        $produkList = $query->orderBy('nama')->get();
    
        return view('admin.atur_harga', compact('produkList', 'totalSaldo'));
    }
    public function create()
    {
        $username = env('DIGIFLAZZ_USERNAME');
        $apiKey   = env('DIGIFLAZZ_KEY');
        
        $signature = md5($username . $apiKey . 'depo');
        $payload = [
            'cmd' => 'deposit',
            'username' => $username,
            'sign' => $signature,
        ];
        $isTesting = env('DIGIFLAZZ_TESTING', false);
        $response = $isTesting
            ? Http::withoutVerifying()->post('https://api.digiflazz.com/v1/cek-saldo', $payload)
            : Http::post('https://api.digiflazz.com/v1/cek-saldo', $payload);

        $resultAPI = $response->json();
        $totalSaldo = $resultAPI['data']['deposit'] ?? 0;
        $response = $isTesting
        ? Http::withoutVerifying()->post('https://api.digiflazz.com/v1/price-list', $payload)
        : Http::post('https://api.digiflazz.com/v1/price-list', $payload);

        $produkList = $response->json()['data'];
        return view('admin.tambah_produk', compact('totalSaldo','produkList'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:produks,kode',
            'harga_jual' => 'required|numeric',
            'status' => 'required|in:aktif,nonaktif',
            'kategori' =>'required',
        ]);

        $username = env('DIGIFLAZZ_USERNAME');
        $apiKey   = env('DIGIFLAZZ_KEY');

        $signature = md5($username . $apiKey . 'depo');
        $payload = [
            'cmd' => 'deposit',
            'username' => $username,
            'sign' => $signature,
        ];

        $isTesting = env('DIGIFLAZZ_TESTING', false);
        $response = $isTesting
        ? Http::withoutVerifying()->post('https://api.digiflazz.com/v1/price-list', $payload)
        : Http::post('https://api.digiflazz.com/v1/price-list', $payload);
        $produkList = $response['data'] ?? [];

        $produkTerpilih = collect($produkList)->firstWhere('buyer_sku_code', $request->kode);

        if (!$produkTerpilih) {
            return back()->withErrors(['kode' => 'Produk tidak ditemukan di Digiflazz.']);
        }

        $payload = [
            'kode'         => $produkTerpilih['buyer_sku_code'],
            'provider'     => $produkTerpilih['brand'],
            'nama'         => $produkTerpilih['product_name'],
            'harga_modal'  => $produkTerpilih['price'],
            'harga_jual'   => $request->harga_jual,
            'status'       => $request->status,
            'kategori'     => $request->kategori, 
        ];

        Produk::create($payload);

        return redirect()->route('admin.harga.index')->with('success', 'Produk berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $username = env('DIGIFLAZZ_USERNAME');
        $apiKey   = env('DIGIFLAZZ_KEY');
        $signature = md5($username . $apiKey . 'depo');
    
        $payload = [
            'cmd' => 'deposit',
            'username' => $username,
            'sign' => $signature,
        ];
    
        $isTesting = env('DIGIFLAZZ_TESTING', false);
        $response = $isTesting
        ? Http::withoutVerifying()->post('https://api.digiflazz.com/v1/cek-saldo', $payload)
        : Http::post('https://api.digiflazz.com/v1/cek-saldo', $payload);
        $resultAPI = $response->json();
        $totalSaldo = $resultAPI['data']['deposit'] ?? 0;
        $produk = Produk::findOrFail($id);
        return view('admin.edit_produk', compact('produk', 'totalSaldo'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga_jual' => 'required|numeric',
            'status' => 'required|in:aktif,nonaktif', 
            'kategori' => 'required|in:PULSA,DATA'
        ]);

        $produk = Produk::findOrFail($id);

        $payload = [
            'nama' => $request->nama,
            'harga_jual' => $request->harga_jual,
            'status' => $request->status,
            'kategori'=> $request->kategori, 
        ];

        $produk->update($payload);

        return redirect()->route('admin.harga.index')->with('success', 'Produk berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('admin.harga.index')->with('success', 'Produk berhasil dihapus.');
    }
}