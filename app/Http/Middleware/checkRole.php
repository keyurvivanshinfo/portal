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
        if(Auth::check()){

            $roleofuser = User::find(Auth::user()->id)->roles->first()?->id;
            if($roleofuser == $role){
                return $next($request);
            }

            
            return response('You are unauthorized to access this page',401);


        }else{
            return response('You are unauthorized to access this page',401);
        }
    }
}
