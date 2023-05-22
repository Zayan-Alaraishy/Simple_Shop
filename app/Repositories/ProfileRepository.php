<?php

namespace App\Repositories;

use App\Interfaces\ProfileRepositoryInterface;
use App\Models\User;

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

    public function toggleAccountPrivacy(User $user): void
    {
        $user->is_public = !$user->is_public;
        $user->save();
    }

    public function findUserById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function updateAddress(User $user, string $country, string $city, string $street): void
    {
        $user->country = $country;
        $user->city = $city;
        $user->street = $street;
        $user->save();
    }
}
