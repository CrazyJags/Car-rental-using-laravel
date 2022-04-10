<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    public function test_register_with_valid_credentials()
    {
        $data = [
            'email'                 => $this->faker->safeEmail(),
            'name'                  => $this->faker->name(),
            'password'              => 'lorem_ipsum',
            'password_confirmation' => 'lorem_ipsum'
        ];
        $this->post('/register',$data)
            ->assertRedirect('/');
    }
}
