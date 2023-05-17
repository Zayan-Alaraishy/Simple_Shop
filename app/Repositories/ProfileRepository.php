<?php

namespace App\Repositories;

use App\Interfaces\ProfileRepositoryInterface;
use App\Models\User;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function updateEmail(User $user, string $email): void
    {
        $user->email = $email;
        $user->save();
    }

    public function updateUsername(User $user, string $username): void
    {
        $user->username = $username;
        $user->save();
    }
}
