<?php

namespace App\Interfaces;

use App\Models\User;

interface ProfileServiceInterface
{
    public function updateEmail(User $user, string $email): void;
    public function updateUsername(User $user, string $username): void;
    public function toggleAccountPrivacy(User $user): void;
    public function findUserById(int $id): User;
}
