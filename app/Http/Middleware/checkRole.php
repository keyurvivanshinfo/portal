<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
     public function handle(Request $request, Closure $next,$role): Response
    {
        if(Auth::check() && Auth::user()->role==$role){
            return $next($request);
        }else{
            return response('Unauthorized',401);
        }
    }
}
