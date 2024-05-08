<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index(Request $request){


           $user = Auth::guard('admin')->user();

           //$user->can('list-role');   //true

           $permissionNames = $user->getPermissionNames();
           $permissions = $user->permissions;
           $permissions = $user->getDirectPermissions();
           $permissions = $user->getPermissionsViaRoles();
           $permissions = $user->getAllPermissions();

           $roles = $user->getRoleNames(); 
           $is_super_admin =  $user->hasRole('Super Admin');
           $is_super_admin_or_admin = $user->hasRole(['Super Admin', 'admin']);
          // dd($is_super_admin_or_admin);

        
           return view("admin.dashboard");
    }
}
