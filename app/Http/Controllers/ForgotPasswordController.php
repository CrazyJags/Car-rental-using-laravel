<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use App\Services\PasswordResetService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Mail;

/**
 * Class ForgotPasswordController
 * Controller to handle process to get password reset code.
 * @package App\Http\Controllers
 */
class ForgotPasswordController extends Controller
{
    /**
     * Return the view to enter the email reset
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(): Factory|View|Application
    {
        return view('shared.forgot-password');
    }

    /**
     * Send the password reset code to the user
     * @param \App\Http\Requests\ForgotPasswordRequest $request
     * @param \App\Services\PasswordResetService $passwordResetService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function store(ForgotPasswordRequest $request, PasswordResetService $passwordResetService): Factory|View|Application
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $code = $passwordResetService->generateCode();
        $passwordResetService->createPasswordReset($user, $code);
        Mail::to($email)->send(new ForgotPasswordMail($code));
        return view('shared.forgot-password-sent');
    }
}
