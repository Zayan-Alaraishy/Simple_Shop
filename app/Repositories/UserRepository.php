<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Carbon;




class UserRepository implements UserRepositoryInterface
{

    public function getUserAddress($user_id)
    {

    }
    public function getUsersAssignedToRoles()
    {
        return User::has('roles')->get();
    }


    public function create($email, $username, $hashedPassword)
    {
        $user = User::create([
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword
        ]);
        return $user;
    }
    public function setEmailVerified($user)
    {
        $user->email_verified_at = Carbon::now();
        $user->save();

        return $user;
    }

    public function assignUserToRole($user, $role)
    {
        return $user->roles()->attach($role);
    }

    public function updateAssignedUser($user, $newDetails)
    {
        $user->update([
            'username' => $newDetails['username'],
            'email' => $newDetails['email'],
        ]);

        $user->roles()->sync([$newDetails['role']]);

        return $user;
    }

    public function deleteUser($userId)
    {
        return User::destroy($userId);
    }
}