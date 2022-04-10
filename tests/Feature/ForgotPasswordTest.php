<?php

namespace Tests\Feature;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Mail;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    public function test_forgot_password_view_is_show()
    {
        $this->get('/forgot-password')
            ->assertViewIs('shared.forgot-password');
    }

    public function test_password_reset_code_is_sent()
    {
        $user = User::factory()->create();
        $data = ['email' => $user->email];
        Mail::fake();
        $this->post('/forgot-password',$data)
            ->assertViewIs('shared.forgot-password-sent');
        Mail::assertSent(ForgotPasswordMail::class);
    }
}
