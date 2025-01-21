<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\Response;

class WalletPolicy
{
    /**
     * Determine if the given wallet can be deleted by the user.
     */
    public function delete(User $user, Wallet $wallet): bool
    {
        return $user->id === $wallet->user_id;
    }
}
