<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
class PermissionsController extends Controller
{

    public function __construct()
    {
        //  $this->middleware(['isAdmin']);
         $this->middleware(['role_or_permission:super-admin|permissions.*,admin']);
    }

    public function index()
    {   
        $permissions = Permission::latest()->paginate(5);
        return view('admin.permissions.index', [
            'permissions' => $permissions
        ]);
    }

    
    public function create() 
    {   
        return view('admin.permissions.create');
    }

  
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);


        $permissionName = $request->name;       
        Permission::create(['name' => $permissionName,'guard_name' => 'admin']);

        return redirect()->route('admin.permissions.index')
            ->withSuccess(__('Permission created successfully.'));
    }

    public function show(Permission $permission)
    {
        return view('admin.permissions.show', [
            'permission' => $permission
        ]);
    }
 
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission
        ]);
    }

  
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id
        ]);

        $permission->update($request->only('name'));

        return redirect()->route('admin.permissions.index')
            ->withSuccess(__('Permission updated successfully.'));
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->withSuccess(__('Permission deleted successfully.'));
    }
}
