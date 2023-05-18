<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthServices;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetLinkEmailRequest;
use App\Http\Requests\StoreUserRequest;
use App\Interfaces\AuthServiceInterface;
use App\Jobs\SendPasswordResetEmailJob;
use App\Services\PasswordResetService;

class AuthController extends Controller
{
    protected AuthServiceInterface $authServices;
    protected PasswordResetService $passwordResetService;

    public function __construct(AuthServices $authServices , PasswordResetService $passwordResetService)
    {
        $this->middleware('guest');
        $this->authServices = $authServices;
        $this->passwordResetService = $passwordResetService;

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
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        $resetStatus = $this->passwordResetService->resetPassword(
            $user,
            $request->password,
            $request->token
        );

        if ($resetStatus) {
            return redirect()->route('login')->with('status', 'Password reset successfully.');
        } else {
            return back()->withErrors(['email' => 'Failed to reset password.']);
        }
    }
    
}
