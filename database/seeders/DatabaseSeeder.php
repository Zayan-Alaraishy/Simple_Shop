<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CartSeeder;

class DatabaseSeeder extends Seeder
{
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
                $this->call(ProductSeeder::class);
                $this->call(UserSeeder::class);
                $this->call(RoleSeeder::class);
                $this->call(RatingSeeder::class);
                $this->call(PermissionSeeder::class);
                $this->call(RolePermissionSeeder::class);
        }
}