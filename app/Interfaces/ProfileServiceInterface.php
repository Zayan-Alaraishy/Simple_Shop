<?php

namespace App\Interfaces;

use App\Models\User;

interface ProfileServiceInterface
{
    public function updateEmail(User $user, string $email): void;
    public function updateUsername(User $user, string $username): void;
}
