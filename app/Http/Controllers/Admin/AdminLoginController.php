<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Authenticatable;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class AdminLoginController
 * Controller to handle admins login
 * @package App\Http\Controllers\Admin
 */
class AdminLoginController extends Controller
{
    use Authenticatable;

    /**
     * Get the view for admin login
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(): View|Factory|Application
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request): Redirector|RedirectResponse|Application
    {
        if (!$this->loginUser($request))
        {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }
        return redirect('/admin');
    }
}
