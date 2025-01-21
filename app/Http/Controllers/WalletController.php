<?php

namespace App\Http\Controllers;

use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Response;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets =  Wallet::with('user', 'walletType')->get();

        return response()->json([
            'data' => WalletResource::collection($wallets),
            'message' => 'Wallets retrieved successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        $wallet->load(['user', 'walletType']);

        return response()->json([
            'data' => new WalletResource($wallet),
            'message' => 'Wallet retrieved successfully',
        ], Response::HTTP_OK);
    }
}
