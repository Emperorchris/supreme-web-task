<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletType extends Model
{
    /** @use HasFactory<\Database\Factories\WalletTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'minimum_balance',
        'monthly_interest_rate'
    ];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }
}
