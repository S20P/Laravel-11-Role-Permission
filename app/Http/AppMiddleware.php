<?php
namespace App\Http;
use Illuminate\Foundation\Configuration\Middleware;

class AppMiddleware{

    public function __invoke(Middleware $middleware){

        $middleware->append([
          
        ]);

        $middleware->appendToGroup('web',[
           
        ]);

        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    }

}

?>