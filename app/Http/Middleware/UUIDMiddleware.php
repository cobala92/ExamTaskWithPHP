<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class UUIDMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->has('uuid')) {
            return response()->json(["message", "Authentication Required!"], 401);
        }

        $user = User::where('uuid', '=', $request->uuid)->first();
        if (!$user) {
            return response()->json(["message", "Authentication Required!"], 401);
        }

        return $next($request);
    }
}
