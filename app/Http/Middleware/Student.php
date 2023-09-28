<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Student
{
    public function handle( Request $request, Closure $next)
    {
        //dd(Auth::user());
        $user=Auth::user();
        if($user){
            // Check if the current user is the specific user
            if ($user->userRole=='student') {
                // Custom logic for specific user
                // You can add your desired code here
                return $next($request);
            }
        }
        return response()->json(['error' => 'Unauthorized.'], 403);
    }
}
