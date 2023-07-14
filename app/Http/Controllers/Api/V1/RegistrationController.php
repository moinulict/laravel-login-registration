<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyRegistrationOTPRequest;
use App\Jobs\SendRegistrationOTPEmailJob;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $otp = mt_rand(100000, 999999);
            $user = User::create($request->validated() + ["otp" => $otp]);

            dispatch(new SendRegistrationOTPEmailJob($user, $otp));

            return response()->json(["status" => true, "message" => "We have sent an email. Please verify email to complete signup process."], 201);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => $e->getMessage()], 400);
        }
    }

    public function verifyEmail(VerifyRegistrationOTPRequest $request)
    {
        // Find the user by email and verification code
        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$user) {
            return response()->json(["status" => false, 'message' => 'Invalid email or OTP code.'], 400);
        }

        // Update user's email_verified_at field
        $user->email_verified_at = now();
        $user->otp = null;
        $user->save();

        return response()->json(["status" => false, 'message' => 'Email verification successful.'], 200);
    }

}
