<?php

namespace App\Repositories;

use App\Interfaces\ProfileRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function updateEmail(User $user, string $email): void
    {
        $user->email_verified_at = null;
        $user->email = $email;
        $user->save();
    }

    public function updateUsername(User $user, string $username): void
    {
        $user->username = $username;
        $user->save();
    }

    public function updatePassword(User $user, string $password): void
    {
        $user->password = Hash::make($password); // Hash the new password
        $user->save();
    }

    public function toggleAccountPrivacy(User $user): void
    {
        $user->is_public = !$user->is_public;
        $user->save();
    }

    public function findUserById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function updateAddress(User $user, string|null $country, string|null $city, string|null $street): void
    {
        $user->country = $country;
        $user->city = $city;
        $user->street = $street;
        $user->save();
    }
}

