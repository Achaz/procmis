<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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
        // Dashboard
        Permission::create(['name' => 'view dashboard']);

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

        Permission::create(['name' => 'update company profile']);

        // Manage Suppliers
        Permission::create(['name' => 'create supplier']);
        Permission::create(['name' => 'view supplier']);
        Permission::create(['name' => 'update supplier']);
        Permission::create(['name' => 'delete supplier']);

        $tenantAdminRole = Role::create(['name' => UserRole::TenantAdmin->value]);

        $tenantAdminRole->givePermissionTo(Permission::pluck('name')->all());

        $staffRole = Role::create(['name' => UserRole::Sales->value]);
        $staffRole->givePermissionTo([
          'view supplier',
        ]);
    }
}
