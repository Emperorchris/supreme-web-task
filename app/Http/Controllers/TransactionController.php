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

        // Find the sender and receiver wallets using their wallet_address
        $senderWallet = Wallet::with('walletType')->where('wallet_address', $validated['sender_wallet_address'])->firstOrFail();
        $receiverWallet = Wallet::with('walletType')->where('wallet_address', $validated['receiver_wallet_address'])->firstOrFail();
        $amount = $validated['amount'];

        // Check if the sender has sufficient balance
        if ($senderWallet->balance < $amount) {
            return response()->json([
                'message' => 'Insufficient balance',
            ], Response::HTTP_BAD_REQUEST);
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

        return response()->json([
            'data' => new TransactionResource($transaction),
            'message' => 'Transfer successful',
        ], Response::HTTP_OK);
    }
}
