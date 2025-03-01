<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->createMany(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'password' => bcrypt('password'),
                    'role' => RoleEnum::ADMIN->value,
                ],
                [
                    'name' => 'User',
                    'email' => 'user@user.com',
                    'password' => bcrypt('password'),
                    'role' => RoleEnum::USER->value,
                ]
            ]
        );
    }
}
