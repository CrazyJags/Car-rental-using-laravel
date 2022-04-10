<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    public function test_login_view_is_shown()
    {
        $this->get('/login')
            ->assertViewIs('user.auth.login');
    }

    public function test_login_with_correct_credentials()
    {
        $user = User::factory()->create();
        $data = ['email', $user->email, 'password' => 'password'];
        $this->post('/login', $data)
            ->assertRedirect('/');
    }

    public function test_login_with_incorrect_credentials()
    {
        $data = ['email' => 'johndoe@hotmail.com', 'password' => 'random_password'];
        $this->post('/login', $data)
            ->assertSessionHasErrors('error');
    }
}
