<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin{
/**
* Handle an incoming request.
*
* @param \Illuminate\Http\Request $request
* @param \Closure $next
* @return mixed
*/
public function handle($request, Closure $next)
{
    if (!Auth::check())
    {
        return redirect('/admin/login');
    }
    
    $user = Auth::user();
        
    if($user->is_admin == 1) {
        return $next($request);
    };

    return redirect('/admin/login');

    }
}