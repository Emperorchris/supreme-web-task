<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'wallet_type_id' => ['required', 'exists:wallet_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'balance' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'The user field is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'wallet_type_id.required' => 'The wallet type field is required.',
            'wallet_type_id.exists' => 'The selected wallet type does not exist.',
            'name.required' => 'The wallet name is required.',
            'name.string' => 'The wallet name must be a valid string.',
            'name.max' => 'The wallet name must not exceed 255 characters.',
            'balance.numeric' => 'The balance must be a valid number.',
            'balance.min' => 'The balance must be at least 0.',
        ];
    }
}
