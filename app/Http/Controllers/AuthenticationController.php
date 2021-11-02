<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthenticationController extends BaseController {
    /**
     * create a new AuthenticationController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * login a user
     */
    public function loginUser(Request $request) {
        /**
         * Validate request data before login of a user
         */
        $this->validate($request, ['email' => 'required|email', 'password' => 'required|string']);
        
        $data = $request->all();
        
        if (User::where('email', $data['email'])->first()) {
            $token = Auth::attempt($data);

            if ($token) return $this->respondWithToken($token);  // successfull login

            return response()->json(['error' => "Email address or password not correct"], 401);  // wrong password
        }
        
        return response()->json(['error' => "Email address or password not correct"], 404);  // user with that email does not exist
    }

    /**
     * logout a user
     */
    public function logoutUser(Request $request) {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * get the authenticated user
     */
    public function getMe() {
        return response()->json(Auth::user());
    }

    /**
     * refresh a token
     */
    public function refreshToken() {
        return $this->respondWithToken(Auth::refresh());
    }
    
    /**
     * get the token
     */
    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
