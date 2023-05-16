<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Interfaces\AuthServiceInterface;
use App\Services\AuthServices;


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

    public function logout() {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
