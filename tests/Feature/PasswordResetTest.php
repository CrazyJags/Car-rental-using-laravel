<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    public function test_password_reset_view_is_shown()
    {
        $this->get('/password-reset')
            ->assertViewIs('shared.password-reset');
    }

    public function test_password_reset_with_valid_code()
    {
        $user = User::factory()->create();
        DB::table('password_resets')->insert([
            'email'      => $user->email,
            'token'      => 'token',
            'created_at' => now()
        ]);
        $data = [
            'password'              => 'password',
            'password_confirmation' => 'password',
            'code'                  => 'token'
        ];
        $this->post('/password-reset',$data)
            ->assertViewIs('shared.password-reset-made');
    }

    public function test_password_reset_with_invalid_code()
    {
        $data = [
            'password'              => 'password',
            'password_confirmation' => 'password',
            'code'                  => 'token'
        ];
        $this->post('/password-reset',$data)
            ->assertSessionHasErrors(['error']);
    }
}
