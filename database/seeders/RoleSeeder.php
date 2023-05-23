<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Config;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = array('super admin', 'admin');

        foreach ($roles as $name) {
            Role::create([
                'name' => $name,
                'description' => $name,
                'is_active' => 1
            ]);
        }

        User::all()->each(function ($user) {
            $user->roles()->attach(Role::all()->first());
        });
    }
}