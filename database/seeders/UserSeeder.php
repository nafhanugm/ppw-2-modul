<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user with the admin role
        User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("password"),
            "role" => "admin",
        ]);

        User::create([
            "name" => "User",
            "email" => "user@gmail.com",
            "password" => Hash::make("password"),
            "role" => "user",
        ]);

        User::create([
            "name" => "Internal Reviewer",
            "email" => "reviewer@gmail.com",
            "password" => Hash::make("password"),
            "role" => "internal_reviewer",
        ]);

        User::factory(10)->create();
    }
}
