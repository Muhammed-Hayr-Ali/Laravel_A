<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\BaseValidator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserBannedRequest
{
    use BaseValidator;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        
        $user = User::where('email', $request->email)->first();
        if ($user && $user->permissions == 'banned') {
            return $this->sendError('Your account has been banned', 401);
        }
        return $next($request);
    }
}
