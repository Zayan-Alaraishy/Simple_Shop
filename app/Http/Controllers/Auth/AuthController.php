<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\AuthServices;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetLinkEmailRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Interfaces\AuthServiceInterface;
use App\Jobs\SendPasswordResetEmailJob;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;


class AuthController extends Controller
{
    protected AuthServiceInterface $authServices;
    public function __construct(AuthServices $authServices)
    {
        $this->middleware('guest');
        $this->authServices = $authServices;
    }

    public function index()
    {
        return view('auth.signup');
    }
    public function store(StoreUserRequest $request)
    {
        $this->authServices->signup(
            $request->email,
            $request->username,
            $request->password
        );
        return redirect()->route('verification.notice');
    }

    public function LoginForm()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $isLogged = $this->authServices->login(
            $request->login,
            $request->password
        );

        if ($isLogged) {
            return redirect()->route('home');
        } else {
            return back()->with('status', 'Invalid Login details');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    
    public function sendResetLinkEmail(SendResetLinkEmailRequest $request)
    {    
        dispatch(new SendPasswordResetEmailJob($request->email));
        
        return back()->with('status', 'Reset link sent successfully');
    }
    
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    
    public function resetPassword(ResetPasswordRequest $request)
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
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
    
}
