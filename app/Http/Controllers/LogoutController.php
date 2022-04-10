<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class LogoutController
 * Controller for user logout
 * @package App\Http\Controllers
 */
class LogoutController extends Controller
{
    /**
     * Logout the connected user
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(): Redirector|Application|RedirectResponse
    {
        Auth::logout();
        return redirect('/login');
    }
}
