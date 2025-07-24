<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBalance extends Model
{
    protected $table = 'customer_balances';
    protected $fillable = ['user_id', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

