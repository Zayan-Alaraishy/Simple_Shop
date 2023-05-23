<?php

namespace App\Interfaces;

use App\Models\User;

interface ProfileServiceInterface
{
    public function updateEmail(User $user, string $email): void;
    public function updateUsername(User $user, string $username): void;
    public function toggleAccountPrivacy(User $user): void;
    public function findUserById(int $id): User;
    public function updateAddress(User $user, string|null $country, string|null $city, string|null $street): void;
    public function updateProfile(User $user, array $data): void;

}
