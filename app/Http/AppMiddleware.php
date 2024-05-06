<?php
namespace App\Http;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\IsAdmin;

class AppMiddleware{

    public function __invoke(Middleware $middleware){
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    }

}

?>