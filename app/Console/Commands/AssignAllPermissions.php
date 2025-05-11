<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignAllPermissions extends Command
{
    protected $signature = 'permissions:assign-all {email : The email of the user to assign permissions to}';
    protected $description = 'Assign all permissions to a user';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }

        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Get all permissions and assign them to the admin role
        $permissions = Permission::all();
        $adminRole->syncPermissions($permissions);

        // Assign admin role to user
        $user->syncRoles([$adminRole]);

        $this->info("All permissions have been assigned to {$email}!");
        return 0;
    }
}
