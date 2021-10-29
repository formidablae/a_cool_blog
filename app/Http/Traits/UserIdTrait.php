<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserIdTrait {
    public function save(...$parameters) {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $this->user_id = $user->id;
        }
        parent::save(...$parameters);
    }
}
