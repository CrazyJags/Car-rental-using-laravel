<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\SetUpAdmin;

class UserManagementTest extends TestCase
{
    use SetUpAdmin;

    public function test_get_all_users(): void
    {
        User::factory(15)->create();
        $this->be($this->getAdmin());
        $this->get('/admin/users')
            ->assertViewIs('admin.pages.user')
            ->assertViewHas(['users']);
    }

    public function test_delete_existing_user(): void
    {
        $user = User::factory()->create();
        $this->be($this->getAdmin());
        $this->delete('/admin/users/'.$user->id)
            ->assertRedirect();
    }

    public function test_delete_non_existing_user(): void
    {
        $this->be($this->getAdmin());
        $this->delete('/admin/users/0')
            ->assertNotFound();
    }
}
