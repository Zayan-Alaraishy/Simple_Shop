<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAddressRequest;
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

    public function profilePage($id)
    {
        $user = $this->profileService->findUserById((int) $id);

        return view('profile.profile' , [
            'username' => $user->username,
            'email' => $user->email,
            'isPublic' => $user->is_public,
            'userId' => $user->id,
            'user' => $user,
        ]);
    }

    public function updateEmail(updateEmailRequest $request)
    {
        $user = Auth::user();
        $this->authorize('update', $user);
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
        $this->authorize('update', $user);
        try {
            $this->profileService->updateUsername($user, $request->username);
            return back()->with('status', 'Username updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function updateAddress(UpdateAddressRequest $request)
    {
        $user = Auth::user();
        $this->authorize('update', $user);
        
        $country = $request->input('country') ?? '';
        $city = $request->input('city') ?? '';
        $street = $request->input('street') ?? '';
        
        try {
            $this->profileService->updateAddress($user, $country, $city, $street);
            return back()->with('status', 'Address updated successfully');
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
