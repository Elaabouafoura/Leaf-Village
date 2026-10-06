<?php

use App\Http\Middleware\BlockAdmin;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        // ✅ Register route middleware aliases here
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'blockAdmin' => BlockAdmin::class,
            'RedirectIfAuthenticated'=> RedirectIfAuthenticated::class

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
