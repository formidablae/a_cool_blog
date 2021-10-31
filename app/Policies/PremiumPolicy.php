<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class PremiumPolicy {
    /**
     * Permission to perform actions of authenticated users
     */
    public function isPremiumUser(User $user) {
        if ($user->subscription === "premium") return Response::allow();
        
        return Response::deny("Unauthorized action, only premium users can delete comments.");
    }
}