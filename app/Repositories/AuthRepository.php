<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function create($email, $username, $hashedPassword)
    {
        $user =  User::create([
            'email' => $email,
            'username'=> $username,
            'password' => $hashedPassword
        ]);
        return  $user;
    }
}
