<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\SetUpAdmin;

class LogoutTest extends TestCase
{
    use SetUpAdmin;

    public function test_user_logout(): void
    {
        $this->be(User::factory()->create());
        $this->post('logout')
            ->assertRedirect('/login');
    }

    public function test_admin_logout(): void
    {
        $this->be($this->getAdmin());
        $this->post('/admin/logout')
            ->assertRedirect('/admin/login');
    }
}
