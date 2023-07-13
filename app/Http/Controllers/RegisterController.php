<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.signup');
    }

    public function register(RegisterRequest $request) 
    {
        $user = User::create($request->validated());
        Auth::login($user);
        return redirect('/')->with('success', "We have sent an email. Please verify email to complete signup process.");
    }
}
