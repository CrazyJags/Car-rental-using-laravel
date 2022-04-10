<?php

namespace App\Services;

use App\Models\User;
use DB;
use Hash;
use Str;

/**
 * Class PasswordResetService
 * Class to handle operations related to user's password reset
 * @package App\Services
 */
class PasswordResetService
{
    private const CODE_LENGTH = 6;

    /**
     * Generate a code to insert in database
     * @return string
     */
    public function generateCode(): string
    {
        return Str::random(self::CODE_LENGTH);
    }

    /**
     * Create the confirmation code for a user
     * @param \App\Models\User $user
     * @param string $token
     * @return void
     */
    public function createPasswordReset(User $user, string $token): void
    {
        DB::table('password_resets')->insert([
            'email'      => $user->email,
            'token'      => $token,
            'created_at' => now()
        ]);
    }

    /**
     * Verify the user confirmation code
     * @param string $token
     * @return bool
     */
    public function isPasswordResetTokenValid(string $token): bool
    {
        return DB::table('password_resets')
            ->where('token', $token)
            ->where('created_at', '>=', now()->subMinutes(30))
            ->exists();
    }

    /**
     * Reset the password with the token
     * @param string $token
     * @param string $password
     * @return void
     */
    public function resetPassword(string $token, string $password): void
    {
        $userEmail = DB::table('password_resets')
                         ->where('token', $token)
                         ->pluck('email')[0];
        User::where('email',$userEmail)
            ->update(['password' => Hash::make($password)]);
    }

    /**
     * Remove a token from the db
     * @param string $token
     * @return void
     */
    public function flush(string $token): void
    {
        DB::table('password_resets')
            ->where('token', $token)
            ->delete();
    }
}
