<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'permissions.*',
            'list-role',
            'create-role',
            'edit-role',
            'delete-role',
            'list-user',
            'create-user',
            'edit-user',
            'delete-user',
            'list-category',
            'create-category',
            'edit-category',
            'delete-category',
            'list-blog',
            'create-blog',
            'edit-blog',
            'delete-blog',            
         ];

         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name' => 'admin']);
          }
    }
}
