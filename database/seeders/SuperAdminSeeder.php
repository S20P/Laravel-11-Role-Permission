<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Creating Super Admin User
         $superAdmin = Admin::create([
            'name' => 'satish Super Admin', 
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $superAdmin->assignRole('super-admin');

        // Creating Admin User
        $admin = Admin::create([
            'name' => 'satish-admin', 
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('admin');

        // Creating Category Manager User
        $categoryManager = Admin::create([
            'name' => 'satish-category', 
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $categoryManager->assignRole('category-manager');
    }
}
