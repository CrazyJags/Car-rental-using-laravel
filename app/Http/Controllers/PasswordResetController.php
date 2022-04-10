<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Services\PasswordResetService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class PasswordResetController
 * Handle password reset
 * @package App\Http\Controllers
 */
class PasswordResetController extends Controller
{
    /**
     * Show the form to enter the password reset
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(): Factory|View|Application
    {
        return view('shared.password-reset');
    }

    /**
     * Reset the user password
     * @param \App\Http\Requests\PasswordResetRequest $request
     * @param \App\Services\PasswordResetService $passwordResetService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function store(PasswordResetRequest $request, PasswordResetService $passwordResetService): Factory|View|Application|RedirectResponse
    {
        $code = $request->input('code');
        $password = $request->input('password');
        if (!$passwordResetService->isPasswordResetTokenValid($code))
        {
            $passwordResetService->flush($code);
            return back()->withErrors(['error' => 'Invalid password reset code']);
        }
        $passwordResetService->resetPassword($code, $password);
        $passwordResetService->flush($code);
        return view('shared.password-reset-made');
    }
}
