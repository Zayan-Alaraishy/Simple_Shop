<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateEmailRequest;
use App\Http\Requests\updateUsernameRequest;
use App\Interfaces\ProfileServiceInterface;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileServiceInterface $profileService)
    {
        $this->profileService = $profileService;
    }

    public function profilePage()
    {
        $user = Auth::user();
        return view('profile.profile' , [
            'username' => $user->username,
            'email' => $user->email,
            'isPublic' => $user->is_public,
        ]);
    }

    public function updateEmail(updateEmailRequest $request)
    {
        $user = Auth::user();

        if ($user->id !== Auth::user()->id) {
            abort(403);
        }

        try {
            $this->profileService->updateEmail($user, $request->email);
            return back()->with('status', 'Email updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function updateUsername(updateUsernameRequest $request)
    {
        $user = Auth::user();

        if ($user->id !== Auth::user()->id) {
            abort(403);
        }

        try {
            $this->profileService->updateUsername($user, $request->username);
            return back()->with('status', 'Username updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function toggleAccountPrivacy()
    {
        $user = Auth::user();
        
        if ($user->id !== Auth::user()->id) {
            abort(403);
        }
        
        try {
            $user->is_public = !$user->is_public;
            $user->save();
            return back()->with('status', 'Account privacy updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
