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
            $email = $request->input('email');
            $username = $request->input('username');
    
            if (!empty($email) && $email !== $user->email) {
                $this->profileService->updateEmail($user, $email);
            }
    
            if (!empty($username) && $username !== $user->username) {
                $this->profileService->updateUsername($user, $username);
            }
    
            if ($request->filled('country') || $request->filled('city') || $request->filled('street')) {
                $country = $request->input('country') ?? '';
                $city = $request->input('city') ?? '';
                $street = $request->input('street') ?? '';
                $this->profileService->updateAddress($user, $country, $city, $street);
            }
    
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
