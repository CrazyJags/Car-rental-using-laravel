<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;

/**
 * Class CreateDefaultAdmin
 * Command to create the default admin if it does not yet exist.
 * @package App\Console\Commands
 */
class CreateDefaultAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the default super admin with his profile if it does not exists';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try
        {
            User::where('role', User::ROLE_ADMIN)->firstOrCreate([
                'name'      => 'Admin admin',
                'email'     => 'admin@gmail.com',
                'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'role'      => User::ROLE_ADMIN
            ]);
            return self::SUCCESS;
        }
        catch (Exception)
        {
            return self::FAILURE;
        }
    }
}
