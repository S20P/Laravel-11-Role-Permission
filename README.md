## Laravel Role & Permission 
     
 PHP 8.2.12 | Laravel : 11.
  
 ## Usefull link : 

    https://medium.com/@mindaugasbernotas2/create-blog-with-laravel-11-and-vue-3-d66627180017
	https://spatie.be/docs/laravel-permission/v6/basic-usage/new-app
	https://www.regur.net/blog/multiple-authentication-in-laravel/
	https://www.allphptricks.com/simple-laravel-10-user-roles-and-permissions/
		   
		   
## Login Details
	
	Super Admin
	-------------------------
	admin1@gmail.com
	12345678
				 
    Admin
    --------------------------
    admin2@gmail.com
    12345678
    
    Category Manager
    --------------------------
    admin3@gmail.com
    12345678

				 
			   
 ## DB name = laravel11_blog	
 =====================Steps/CMD=====================

    composer create-project --prefer-dist  laravel/laravel blog
	cd blog
    php artisan serve
	php artisan migrate


    #Add AUTH
    ---------------------------------
    composer require laravel/ui --dev
    php artisan ui bootstrap --auth
    # npm install && npm run prod
    
    php artisan make:model Admin -m
    php artisan migrate
    php artisan make:controller Admin/HomeController		   
    php artisan make:middleware IsAdmin	
    
    git add . && git commit -m "Setup auth scaffold"


    Add Role Permissions package
    ----------------------------------
    composer require spatie/laravel-permission
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
    php artisan migrate:fresh

    git add .
    git commit -m "Add Spatie Laravel Permissions package"
    

    
    # Add `HasRoles` trait to User model
    -----------------------------------------
    use Spatie\Permission\Traits\HasRoles;
    use HasRoles;
    
    git add . && git commit -m "Add HasRoles trait"


    #Seeder
    -----------------------------------------
    php artisan make:seed AdminTableSeeder
    php artisan make:seeder PermissionSeeder
    php artisan make:seeder RoleSeeder
    php artisan make:seeder SuperAdminSeeder	
    
    php artisan db:seed
    

    # Boostrap 5 Admin Free Template
    --------------------------------------------
    https://zuramai.github.io/mazer/
    https://zuramai.github.io/mazer/docs/index.html

    
    #Category Module
    -----------------------------------------
    php artisan make:model Category -m --requests			  
    php artisan make:controller Admin/CategoryController --resource

    #Permissions Module
    ------------------------------------------------			
    php artisan make:controller Admin/PermissionsController --resource
    Route::resource('permissions', PermissionsController::class);	

    #migrate
    ----------------------------------------------
    php artisan migrate:fresh --seed
    
    #Controllers
    -----------------------------------------------		
    php artisan make:controller Admin/RoleController --resource
    php artisan make:controller Admin/UserController --resource			  

    #request Validation
    -----------------------------------------------       
    php artisan make:request StoreRoleRequest
    php artisan make:request UpdateRoleRequest
    php artisan make:request StoreUserRequest
    php artisan make:request UpdateUserRequest
    
    #views
    --------------------------------------------------		       		  
    php artisan make:view admin.users.index
    php artisan make:view admin.users.create
    php artisan make:view admin.users.edit
    php artisan make:view admin.users.show
    php artisan make:view admin.roles.index
    php artisan make:view admin.roles.create
    php artisan make:view admin.roles.edit
    php artisan make:view admin.roles.show
    php artisan make:view admin.categories.index
    php artisan make:view admin.categories.create
    php artisan make:view admin.categories.edit
    php artisan make:view admin.categories.show

    
    
    #ClearCache
    --------------------------------------------------		  
    php artisan optimize:clear

    #Roles
    ----------------------------------------------------
    super-admin
    admin
    category-manager
    
    #Permissions
    ----------------------------------------------------
    $permissions = [
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
    'delete-category'
    ];
    
    #Others
    ----------------------------------------------------
    @php
    $user = Auth::guard('admin')->user();    
    @endphp

    @if($user->hasAnyRole(['super-admin', 'admin']))
    @endif

    @if($user->can('list-category'))
        {{-- <h1>list-category</h1> --}}
    @endif

    $user->hasPermissionTo('publish articles', 'admin');

    @haspermission('list-category','admin')
        <h1>list-category</h1>
    @endhaspermission.


    @role('super-admin','admin')
    I am a writer!
    @else
    I am not a writer...
    @endrole		  