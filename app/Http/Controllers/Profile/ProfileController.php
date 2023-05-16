<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateEmailRequest;
use App\Http\Requests\updateUsernameRequest;

class ProfileController extends Controller
{
    public function profilePage()
    {
        return view('profile.profile');
    }

    public function updateEmail(updateEmailRequest $request)
    {
        $user = auth()->user();
        $user->email = $request->email;
        $user->save();
        return back()->with('status', 'Email updated successfully');
    }

    public function updateUsername(updateUsernameRequest $request)
    {
        $user = auth()->user();
        $user->username = $request->username;
        $user->save();
        return back()->with('status', 'Username updated successfully');
    }
}
