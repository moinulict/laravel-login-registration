<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->email_verified_at) {

                return response()->json(["status" => true, 'user' => $user, 'message' => 'Login successful'], 200);
                
            } else {
                Auth::logout();
                return response()->json(["status" => false, 'message' => 'Email not verified.'], 401);
            }
        }

        return response()->json(["status" => false, 'message' => 'Invalid credentials.'], 401);
    }
}
