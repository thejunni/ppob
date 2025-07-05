<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerBalanceSeeder extends Seeder
{
    public function run()
    {
        DB::table('customer_balances')->insert([
            [
                'user_id' => 3,
                'balance' => 1000000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
