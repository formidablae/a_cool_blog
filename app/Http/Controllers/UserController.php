<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Client\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController {
    /**
     * getter of a user given its id
     */
    public function getUser($id) {
        return User::find($id);
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
        $user->fill($request->all());
        $user->id = $request["id"];
        $user->save();
    }

    /**
     * delete a user given its id
     */
    public function deleteUser($id) {
        $user = $this->getUser($id);
        $user->delete();
    }
}
