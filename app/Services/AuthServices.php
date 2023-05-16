<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmailVerificationNotification;

class AuthServices implements AuthServiceInterface
{

    protected AuthRepositoryInterface $authRepository;
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function signup($email, $username, $password)
    {
        $hashPassword = Hash::make($password);
        $user = $this->authRepository->create($email, $username, $hashPassword);
        dispatch(new SendEmailVerificationNotification($user));
        return auth()->login($user);
    }


    public function login($login, $password)
    {
        $credentials = [
            filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $login,
            'password' => $password
        ];

        return auth()->attempt($credentials);
    }
}
