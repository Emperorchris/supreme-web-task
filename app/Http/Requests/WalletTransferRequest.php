<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletTransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sender_wallet_address' => ['required', 'string', 'exists:wallets,wallet_address'],
            'receiver_wallet_address' => ['required', 'string', 'exists:wallets,wallet_address', 'different:sender_wallet_address'],
            'amount' => ['required', 'numeric', 'min:0.01'],
        ];
    }
}
