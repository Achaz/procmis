<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Manage Roles
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        // Manage Users
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // Manage Suppliers
        Permission::create(['name' => 'create supplier']);
        Permission::create(['name' => 'view supplier']);
        Permission::create(['name' => 'update supplier']);
        Permission::create(['name' => 'delete supplier']);

        $superAdminRole = Role::create(['name' => 'super admin']);

        $superAdminRole->givePermissionTo(Permission::pluck('name')->all());

        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo([
          'view supplier',
        ]);
    }
}
