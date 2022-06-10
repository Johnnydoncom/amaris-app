<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'publish products']);
        Permission::create(['name' => 'unpublish products']);

        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'view users']);

        Role::insert([
            [
                'name'       => UserRole::SUPERADMIN,
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => UserRole::ADMIN,
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => UserRole::SHOPMANAGER,
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => UserRole::CUSTOMER,
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        // Super Admin
        $superAdminRole = Role::find(1);
        $superAdmin = User::find(1);
        if (!blank($superAdmin) && !blank($superAdminRole)) {
            $superAdmin->assignRole($superAdminRole->name);
        }

        // Admin
        $adminRole = Role::find(2);
        $adminUser = User::find(2);
        if (!blank($adminUser) && !blank($adminRole)) {
            $adminUser->assignRole($adminRole->name);
        }

        // Shop Manager
        $mrole = Role::find(3);
        $muser = User::find(3);
        if (!blank($muser) && !blank($mrole)) {
            $muser->assignRole($mrole->name);
        }

        // Customer
        $crole = Role::find(4);
        $cuser = User::find(4);
        if (!blank($cuser) && !blank($crole)) {
            $cuser->assignRole($crole->name);
        }
    }
}
