<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\ProfileServiceInterface;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileServiceInterface $profileService)
    {
        $this->profileService = $profileService;
    }

    public function profilePage($id)
    {
        $user = $this->profileService->findUserById((int) $id);

        return view('profile.profile', [
            'username' => $user->username,
            'email' => $user->email,
            'isPublic' => $user->is_public,
            'userId' => $user->id,
            'user' => $user,
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $this->authorize('update', $user);
    
        try {
            $this->profileService->updateProfile($user, $request->all());
            return back()->with('status', 'Profile updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
    

    public function toggleAccountPrivacy()
    {
        $user = Auth::user();
        $this->authorize('update', $user);
        try {
            $this->profileService->toggleAccountPrivacy($user);
            return back()->with('status', 'Account privacy updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
