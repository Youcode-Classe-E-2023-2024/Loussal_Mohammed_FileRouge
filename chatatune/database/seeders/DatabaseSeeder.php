<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\RoleController;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::where('email', 'loussalmohammed@gmail.com');

        // Check if the admin user exists
        if ($admin) {
            // Assign the 'admin' role to the admin user
            RoleController::assignRole($admin->id, 'admin');
        } else {
            // If the admin user with id 21 does not exist, display an error message
            echo "Error: Admin user with id 21 not found.";
        }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 't    est@example.com',
        // ]);
    }
}
