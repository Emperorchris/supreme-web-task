<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletTransferRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function transfer(WalletTransferRequest $request)
    {
        $validated = $request->validated();

        $senderWallet = Wallet::findOrFail($validated->sender_wallet_id);
        $receiverWallet = Wallet::findOrFail($validated->receiver_wallet_id);
        $amount = $validated->amount;

        if ($senderWallet->balance < $amount) {
            return response()->json([
                    'message' => 'Insufficient balance',
                ], Response::HTTP_BAD_REQUEST
            );
        }

        // Update balances
        $senderWallet->balance -= $amount;
        $receiverWallet->balance += $amount;

        $senderWallet->save();
        $receiverWallet->save();

        // Record transaction
        $transaction = Transaction::create([
            'sender_wallet_id' => $senderWallet->id,
            'receiver_wallet_id' => $receiverWallet->id,
            'amount' => $amount,
        ]);

        // Eager load senderWallet and receiverWallet relationships
        $transaction->load(['senderWallet.user', 'receiverWallet.user']);

        return response()->json([
            'data' => new TransactionResource($transaction),
            'message' => 'Transfer successful',
        ], Response::HTTP_OK);
    }
}
