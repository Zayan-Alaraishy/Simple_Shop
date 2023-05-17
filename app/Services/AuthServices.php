<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Interfaces\AuthRepositoryInterface;
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


    public function login($loginInput, $password)
    {
        $credentials = [
            filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $loginInput,
            'password' => $password
        ];

        return auth()->attempt($credentials);
    }

    public function resetPassword($request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
   return $status;
    }
}
