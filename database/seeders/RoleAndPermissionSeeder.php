<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionsByRole = [
            'admin' => [
                'user', 'desa','kendaraan'
            ],
            'desa' => [
                'kendaraan'
            ]
        ];

        collect($permissionsByRole)
            ->map(function ($permission){
                collect($permission)->each(function ($permissionName){
                    Permission::updateOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
                });
            });

        collect($permissionsByRole)
            ->map(function ($permission, $role){
                $role = Role::create(['name' => $role]);

                $role->syncPermissions($permission);
            });
    }
}
