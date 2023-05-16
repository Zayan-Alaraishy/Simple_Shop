<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailVerificationNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {

        $request->fulfill();
        return redirect('/home');
    }

    public function sendVerificationEmail(Request $request)
    {
        dispatch(new SendEmailVerificationNotification($request->user()));

        return back()->with('message', 'Verification link sent!');
    }
}
