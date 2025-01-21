<?php

namespace App\Http\Controllers;

use App\Models\WalletType;
use App\Http\Requests\StoreWalletTypeRequest;
use App\Http\Resources\WalletTypeResource;
use Illuminate\Http\Response;

class WalletTypeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWalletTypeRequest $request)
    {
        // Create a new WalletType using validated data
        $walletType = WalletType::create($request->validated());

        // Return a success response
        return response()->json([
            'message' => 'Wallet type created successfully.',
            'data' => new WalletTypeResource($walletType),
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WalletType $walletType)
    {
        // Check if there are wallets associated with this type
        if ($walletType->wallets()->exists()) {
            return response()->json([
                'message' => 'Cannot delete wallet type with associated wallets.',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Delete the wallet type
        $walletType->delete();

        // Return a success response
        return response()->json([
            'message' => 'Wallet type deleted successfully.',
        ], Response::HTTP_OK);
    }
}
