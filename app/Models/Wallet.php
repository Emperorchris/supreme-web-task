<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    /** @use HasFactory<\Database\Factories\WalletFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_type_id',
        'name',
        'balance',
        'wallet_address',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($wallet) {
            $wallet->wallet_address = self::generateUniqueWalletAddress();
        });
    }

    private static function generateUniqueWalletAddress()
    {
        do {
            $walletAddress = str_pad(mt_rand(0, 99999999999), 11, '0', STR_PAD_LEFT);
        } while (self::where('wallet_address', $walletAddress)->exists());
        
        return $walletAddress;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function walletType()
    {
        return $this->belongsTo(WalletType::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'sender_wallet_id');
    }
}
