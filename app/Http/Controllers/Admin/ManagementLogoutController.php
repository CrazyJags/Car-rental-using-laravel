<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

/**
 * Class ManagementLogoutController
 * Logout for admins
 * @package App\Http\Controllers\Admin
 */
class ManagementLogoutController extends Controller
{
    /**
     * Logout the connected admin
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(): Redirector|Application|RedirectResponse
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
