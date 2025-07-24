<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Provider;
use App\Models\TransaksiPulsa;
use App\Services\DigiFlazzService;
use Illuminate\Support\Facades\Http;

class DashboardAdminController extends Controller
{
    protected $digiflazz;

    public function __construct(DigiFlazzService $digiflazz)
    {
        $this->digiflazz = $digiflazz;
    }
    // public function index()
    // {
    //     // Hitung jumlah transaksi berdasarkan status
    //     $sukses = Transaksi::where('status', 'sukses')->count();
    //     $gagal = Transaksi::where('status', 'gagal')->count();
    //     $pending = Transaksi::where('status', 'pending')->count();

    //     // Hitung total harga modal dan profit dari transaksi sukses
    //     $totalBiaya = Transaksi::where('status', 'sukses')->sum('harga_modal');
    //     $totalProfit = Transaksi::where('status', 'sukses')->sum('profit');

    //     // Total saldo dari provider
    //     $username = env('DIGIFLAZZ_USERNAME');
    //     $apiKey   = env('DIGIFLAZZ_KEY');
        
    //     $signature = md5($username . $apiKey . 'depo');
        
    //     $payload = [
    //         'cmd' => 'deposit',
    //         'username' => $username,
    //         'sign' => $signature,
    //     ];

    //     // Kirim POST request tanpa verifikasi SSL (untuk testing lokal)
    //     $response = Http::withoutVerifying()
    //                     ->post('https://api.digiflazz.com/v1/cek-saldo', $payload);

    //     $resultAPI = $response->json();
    //     $totalSaldo = $resultAPI['data']['deposit'] ?? 0;
    //     // $totalSaldo = Provider::sum('saldo');

    //     // Ambil 10 transaksi terbaru
    //     $transaksiTerbaru = Transaksi::latest()->take(10)->get();

    //     // Kirim data ke view
    //     return view('admin.dashboard', compact(
    //         'sukses', 'gagal', 'pending',
    //         'totalBiaya', 'totalProfit', 'totalSaldo',
    //         'transaksiTerbaru'
    //     ));
    // }
    public function index()
{
    // Hitung jumlah transaksi berdasarkan status
    $sukses = TransaksiPulsa::where('status', 'sukses')->count();
    $gagal = TransaksiPulsa::where('status', 'gagal')->count();
    $pending = TransaksiPulsa::where('status', 'pending')->count();

    // Hitung total harga modal dan profit dari transaksi sukses
    $totalBiaya = TransaksiPulsa::where('status', 'sukses')->sum('harga_modal');
    $totalProfit = TransaksiPulsa::where('status', 'sukses')->sum('profit');

    // Total saldo dari provider (cek ke API Digiflazz)
    $username = env('DIGIFLAZZ_USERNAME');
    $apiKey   = env('DIGIFLAZZ_KEY');
    $signature = md5($username . $apiKey . 'depo');

    $payload = [
        'cmd' => 'deposit',
        'username' => $username,
        'sign' => $signature,
    ];

    $response = Http::withoutVerifying()
                    ->post('https://api.digiflazz.com/v1/cek-saldo', $payload);

    $resultAPI = $response->json();
    $totalSaldo = $resultAPI['data']['deposit'] ?? 0;

    // Ambil 10 transaksi terbaru
    $transaksiTerbaru = TransaksiPulsa::latest()->take(10)->get();

    return view('admin.dashboard', compact(
        'sukses', 'gagal', 'pending',
        'totalBiaya', 'totalProfit', 'totalSaldo',
        'transaksiTerbaru'
    ));
}
}
