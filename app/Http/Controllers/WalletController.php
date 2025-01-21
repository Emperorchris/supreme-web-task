<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletRequest;
use App\Http\Resources\SimpleWalletResource;
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
        $wallets = Wallet::with('user', 'walletType')->get();

        return response()->json([
            'data' => WalletResource::collection($wallets),
            'message' => 'Wallets retrieved successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created wallet in storage.
     */
    public function store(StoreWalletRequest $request)
    {
        $validated = $request->validated();

        // Create a wallet with auto-generated wallet_address
        $wallet = Wallet::create($validated);

        $wallet->load('walletType');

        return response()->json([
            'data' => new SimpleWalletResource($wallet),
            'message' => 'Wallet created successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified wallet.
     */
    public function show(Wallet $wallet)
    {
        $wallet->load(['user', 'walletType']);

        return response()->json([
            'data' => new WalletResource($wallet),
            'message' => 'Wallet retrieved successfully',
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified wallet from storage.
     */
    public function destroy(Wallet $wallet)
    {
        $this->authorize('delete', $wallet);

        $wallet->delete();

        return response()->json([
            'message' => 'Wallet deleted successfully',
        ], Response::HTTP_OK);
    }
}
