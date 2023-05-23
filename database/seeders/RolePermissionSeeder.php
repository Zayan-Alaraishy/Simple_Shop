<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'super admin',
                'permissions' => [
                    'create products',
                    'edit products',
                    'delete products',
                    // Add more permissions as needed
                ],
            ],
            [
                'name' => 'admin',
                'permissions' => [
                    'create products',
                    'edit products',
                    'delete products',
                    // Add more permissions as needed
                ],
            ],
        ];

        foreach ($roles as $roleData) {
            $role = Role::where('name', $roleData['name'])->first();

            if ($role) {
                $permissions = [];

                foreach ($roleData['permissions'] as $permissionName) {
                    $permission = Permission::where('name', $permissionName)->first();

                    if ($permission) {
                        $permissions[] = $permission->id;
                    }
                }

                $role->permissions()->sync($permissions);
            }
        }
    }

}