<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegistrationOTPEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $verificationOTP;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $verificationOTP)
    {
        $this->user = $user;
        $this->verificationOTP = $verificationOTP;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.registration-otp', ['verificationOTP' => $this->verificationOTP], function ($message) {
            $message->to($this->user->email)->subject('Email Verification');
        });
    }
}
