<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;
use Stringable;

class UserController extends BaseController {
    /**
     * getter of a user given its id
     */
    public function getUser($user_id) {
        return User::findOrFail($user_id);
    }

    /**
     * getter of all users
     */
    public function getAllUsers() {
        return User::all();
    }

    /**
     * create a new user
     */
    public function newUser(Request $request) {
        /**
         * Validate request data before new user creation
         */
        $this->validate($request, [
            'first_name' => 'filled|string',
            'last_name' => 'filled|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:30',
            'picture' => 'filled|url'
        ]);

        $user = new User;
        $data = $request->all();
        $user->fill($data);
        $user->password = Hash::make($data["password"]);
        $user->api_token = Str::random(64);
        $user->save();
        return $user;
    }

    /**
     * delete a user given its id
     */
    public function deleteUser($user_id) {
        User::findOrFail($user_id);  // TODO: to remove when auth implemented
        User::where('id', $user_id)->delete();
    }
}
