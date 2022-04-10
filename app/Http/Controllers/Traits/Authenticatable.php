<?php

namespace App\Http\Controllers\Traits;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Trait Authenticatable
 * Methods related to user authentication.
 * @package App\Http\Controllers\Traits
 */
trait Authenticatable
{
    /**
     * Register a new user.
     * @param RegisterRequest $request
     * @return void
     */
    public function registerUser(RegisterRequest $request): void
    {
        $userData = $request->only(['name', 'email', 'password']);
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        Auth::login($user);
    }

    /**
     * Log in a user.
     * @param \App\Http\Requests\LoginRequest $request
     * @return bool
     */
    public function loginUser(LoginRequest $request): bool
    {
        $userData = $request->only(['email', 'password']);
        if (Auth::attempt($userData))
        {
            Auth::login(Auth::user(),$request->has('remember-me'));
            return true;
        }
        return false;
    }
}
