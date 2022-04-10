<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Authenticatable;
use App\Http\Requests\RegisterRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class UserRegisterController
 * Controller for user registration
 * @package App\Http\Controllers
 */
class UserRegisterController extends Controller
{
    use Authenticatable;

    /**
     * Show the register page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(): Factory|View|Application
    {
        return view('user.auth.register');
    }

    /**
     * Register a new user.
     * @param RegisterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RegisterRequest $request): Redirector|RedirectResponse|Application
    {
        $this->registerUser($request);
        return redirect('/');
    }
}
