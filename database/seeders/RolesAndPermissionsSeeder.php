<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $clientRole = Role::create(['name' => 'client']);
        $ulamaRole = Role::create(['name' => 'ulama']);
        $adminRole = Role::create(['name' => 'admin']);

        // Optionally, create permissions and assign them to roles
        $manageUsersPermission = Permission::create(['name' => 'manage users']);
        $viewDashboardPermission = Permission::create(['name' => 'view dashboard']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($manageUsersPermission);
        $adminRole->givePermissionTo($viewDashboardPermission);

        $clientRole->givePermissionTo($viewDashboardPermission);
        $ulamaRole->givePermissionTo($viewDashboardPermission);
    }
}
