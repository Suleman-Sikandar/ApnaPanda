<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return response()->view('admin.errors.401', [], 401);
        }

        if (!validatePermissions(Route::getFacadeRoot()->current()->uri())) {
            return response()->view('admin.errors.403', [], 403);
        }

        return $next($request);
    }
}
