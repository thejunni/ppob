<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPulsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $balance = $user->balance ? $user->balance->balance : 0;
        return view('customer.dashboard', [
            'user' => $user, $balance
        ]);
    }
    public function riwayatPembelian()
    {
        $user = Auth::user();
        $balance = $user->balance ? $user->balance->balance : 0;

        $transaksi = TransaksiPulsa::with('produk')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();

        return view('user.riwayat-pembelian', compact('transaksi', 'user','balance'));
    }

}