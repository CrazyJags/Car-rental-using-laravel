<?php

namespace Tests\Feature\Commands;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\SetUpAdmin;

class CreateDefaultAdminTest extends TestCase
{
    use SetUpAdmin;

    public function test_command_with_no_admin()
    {
        $this->artisan('admin:create')
            ->assertSuccessful();
        $this->assertDatabaseHas('users', [
            'email' => 'admin@gmail.com',
            'role'  => User::ROLE_ADMIN
        ]);
    }

    public function test_command_with_existing_admin()
    {
        User::create([
            'name'     => 'Admin admin',
            'email'    => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role'     => User::ROLE_ADMIN
        ]);
        $this->artisan('admin:create')
            ->assertSuccessful();
        $this->assertDatabaseCount('users', 1);
    }
}
