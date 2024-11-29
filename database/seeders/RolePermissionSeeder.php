<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions for profiles
        Permission::create(['name' => 'edit profiles']);

        // Permissions for project
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'edit projects']);
        Permission::create(['name' => 'delete projects']);

        // Permissions for task
        Permission::create(['name' => 'create tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'delete tasks']);

        // Permissions for application (apply to project)
        Permission::create(['name' => 'create applications']);

        // Permissions for comments
        Permission::create(['name' => 'create comments']);

        // Permissions for reviews (ulasan)
        Permission::create(['name' => 'create reviews']);
        Permission::create(['name' => 'edit reviews']);
        Permission::create(['name' => 'delete reviews']);

        // create roles and assign existing permissions
        $freelancerRole = Role::create(['name' => 'freelancer']);
        $freelancerRole->givePermissionTo([
            'edit profiles',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'create applications',
            'create comments'
        ]);

        $clientRole = Role::create(['name' => 'client']);
        $clientRole->givePermissionTo([
            'edit profiles',
            'create projects',
            'edit projects',
            'delete projects',
            'create comments',
            'create reviews',
            'edit reviews',
            'delete reviews'
        ]);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Freelancer User',
            'email' => 'freelancer@example.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($freelancerRole);

        $user = \App\Models\User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($clientRole);
    }
}
