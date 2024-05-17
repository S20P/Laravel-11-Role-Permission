<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = Role::create(['name' => 'super-admin', 'guard_name' => 'admin']);
        $permissions = Permission::pluck('name');
        $super_admin->givePermissionTo($permissions);
        // $super_admin->givePermissionTo([
        //     'list-role',
        //     'create-role',
        //     'edit-role',
        //     'delete-role',
        //     'list-user',
        //     'create-user',
        //     'edit-user',
        //     'delete-user',
        //     'list-category',
        //     'create-category',
        //     'edit-category',
        //     'delete-category'
        // ]);


        $admin = Role::create(['name' => 'admin','guard_name' => 'admin']);      
        $admin->givePermissionTo([
            'list-category',
            'create-category',
            'edit-category',
            'delete-category'
        ]);
        
        //Category Manager
        $categoryManager = Role::create(['name' => 'category-manager','guard_name' => 'admin']);
        $categoryManager->givePermissionTo([
            'list-category',
            'create-category',
            'edit-category',
            'delete-category'
        ]);

        //Blog Manager
        $blogManager = Role::create(['name' => 'blog-manager','guard_name' => 'admin']);
        $blogManager->givePermissionTo([
            'list-category',
            'create-category',
            'edit-category',
            'delete-category',
            'list-blog',
            'create-blog',
            'edit-blog',
            'delete-blog', 
        ]);      

    }
}
