<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::create(['name' => 'create_room']);
        Permission::create(['name' => 'edit_room']);
        Permission::create(['name' => 'delete_room']);

        Permission::create(['name' => 'create_booking']);
        Permission::create(['name' => 'edit_booking']);
        Permission::create(['name' => 'delete_booking']);
        Permission::create(['name' => 'approve_booking']);

        // Roles
        $roleUser = Role::create(['name' => 'user'])
            ->givePermissionTo(['create_booking', 'edit_booking']);

        $roleManager = Role::create(['name' => 'manager'])
            ->givePermissionTo('create_room', 'edit_room', 'edit_booking', 'approve_booking');

        $roleAdmin = Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        // Users
        $userUser = \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@domain.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $userUser->assignRole($roleUser);

        $userManager = \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@domain.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $userManager->assignRole($roleManager);

        $userAdmin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $userAdmin->assignRole($roleAdmin);
    }
}
