<?php

namespace App\Http\Controllers;

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
}