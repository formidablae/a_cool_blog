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
    public function getUser($id) {
        return User::findOrFail($id);
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
    public function deleteUser($id) {
        User::where('id', $id)->delete();
    }
}
