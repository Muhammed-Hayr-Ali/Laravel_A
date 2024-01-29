<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Auth;

class UserBannedAuth
{
    use BaseResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permissions = Auth::user()->permissions;
        if ($permissions == 'banned') {
            return $this->sendError('Your account has been banned', 401);
        }

        return $next($request);
    }
}
