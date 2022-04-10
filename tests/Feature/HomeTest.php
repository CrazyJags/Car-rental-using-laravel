<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_user_can_access_home_anonymously(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertViewIs('user.pages.home');
    }

    public function test_authenticated_user_can_access_home(): void
    {
        $this->be(User::factory()->make());
        $this->get('/')
            ->assertOk()
            ->assertViewIs('user.pages.home');
    }
}
