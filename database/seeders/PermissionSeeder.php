<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create products',
            'edit products',
            'delete products',
            // Add more permissions as needed
        ];

        foreach ($permissions as $name) {
            Permission::create([
                'name' => $name,
                'description' => null,
            ]);
        }
    }
}