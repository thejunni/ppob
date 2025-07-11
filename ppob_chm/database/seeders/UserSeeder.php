<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder {
    public function run(): void{
        User::create([
            'name' => 'Nasabah Juniarta',
            'email' => 'juniarta@koperasi.com',
            'password' => Hash::make('juni123'),
            'role' => 'user',
        ]);
    }
}

