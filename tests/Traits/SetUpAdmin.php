<?php

namespace Tests\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Trait SetUpAdmin
 * Trait for admin helper method for testing purposes.
 * @package Tests\Traits
 */
trait SetUpAdmin
{
    /**
     * Creates and return an admin.
     * @return \Illuminate\Database\Eloquent\Model|\App\Models\User
     */
    public function getAdmin(): Model|User
    {
        return User::create([
            'name'           => $this->faker->name(),
            'email'          => $this->faker->unique()->safeEmail(),
            'password'       => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role'           => User::ROLE_ADMIN
        ]);
    }
}
