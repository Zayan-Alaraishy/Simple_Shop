<?php

namespace App\Interfaces;

use App\Models\User;

interface ProfileRepositoryInterface
{
    public function updateEmail(User $user, string $email): void;
    public function updateUsername(User $user, string $username): void;
    public function updatePassword(User $user, string $password): void; // Add this method
    public function toggleAccountPrivacy(User $user): void;
    public function findUserById(int $id): User;
    public function updateAddress(User $user, string $country, string $city, string $street): void;
    
}
