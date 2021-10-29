<?php

namespace App\Http\Traits;
use Illuminate\Http\Client\Request;

trait UserTrait {
    public function getUser($user_id) {}

    public function getAllUsers() {}

    public function newUser(Request $request) {}

    public function loginUser(Request $request) {}

    public function deleteUser() {}
}
