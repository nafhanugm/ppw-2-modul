<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authenticatedRole = ["admin", "internal_review"];
        if (!in_array(auth()->user()->role, $authenticatedRole)) {
            return response()->json(["message" => "Unauthorized"], 401);
        }
        return $next($request);
    }
}
