<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define roles
        $roles = ['user', 'commercial', 'operational', 'administrative'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Package
        $permissionsWithRole = [
            'create package' => [
                'administrative',
                'commercial'
            ],
            'edit package'=>[
                'administrative',
                'commercial'
            ],
            'delete package'=>[
                'administrative',
                'commercial'
            ],
            'get packages'=>[
                'administrative',
                'commercial',
                'operational',
                'user'
            ],
            'show package'=>[
                'administrative',
                'commercial',
                'operational',
                'user'
            ]
        ];

        foreach ($permissionsWithRole as $permission => $roles_permission) {
            $createdPermission = Permission::create(['name' => $permission]);

            foreach ($roles_permission as $roleName) {
                $role = Role::findByName($roleName);
        
                if ($role) {
                    $role->givePermissionTo($createdPermission);
                }
            }
        }
        
    }
}