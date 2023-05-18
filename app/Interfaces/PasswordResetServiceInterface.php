<?php

namespace App\Interfaces;

use App\Models\User;

interface PasswordResetServiceInterface
{
    public function resetPassword(User $user, string $password, string $token): bool;
}
