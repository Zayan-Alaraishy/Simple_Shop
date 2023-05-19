<?php 

namespace App\Services;

use App\Interfaces\PasswordResetServiceInterface;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetService implements PasswordResetServiceInterface
{
    protected $passwordBroker;

    public function __construct(PasswordBroker $passwordBroker)
    {
        $this->passwordBroker = $passwordBroker;
    }

    public function resetPassword(User $user, string $password, string $token): bool
    {
        $resetStatus = $this->passwordBroker->reset(
            ['email' => $user->email, 'password' => $password, 'password_confirmation' => $password, 'token' => $token],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $resetStatus === PasswordBroker::PASSWORD_RESET;
    }
}
