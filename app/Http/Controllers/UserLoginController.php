<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Authenticatable;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class UserLoginController
 * Handle user login process
 * @package App\Http\Controllers
 */
class UserLoginController extends Controller
{
    use Authenticatable;

    /**
     * Get the view for user login
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(): View|Factory|Application
    {
        return view('user.auth.login');
    }

    /**
     * Handle user login
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request): Redirector|RedirectResponse|Application
    {
        if (!$this->loginUser($request))
        {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }
        return redirect('/');
    }
}
