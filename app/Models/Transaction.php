<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'sender_wallet_id',
        'receiver_wallet_id',
        'amount'
    ];

    public function senderWallet()
    {
        return $this->belongsTo(Wallet::class, 'sender_wallet_id');
    }

    public function receiverWallet()
    {
        return $this->belongsTo(Wallet::class, 'receiver_wallet_id');
    }

    // Define the relationship to the User model via sender wallet
    public function senderUser()
    {
        return $this->belongsToThrough(User::class, Wallet::class, 'sender_wallet_id', 'user_id');
    }

    // Define the relationship to the User model via receiver wallet
    public function receiverUser()
    {
        return $this->belongsToThrough(User::class, Wallet::class, 'receiver_wallet_id', 'user_id');
    }
}
