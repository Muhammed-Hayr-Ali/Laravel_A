<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\BaseResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ExpirationDateRequest
{
    use BaseResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dataTime = Carbon::now();

        $user = User::where('email', $request->email)->first();

        if ($user->expiration_date == null) {
            return $this->sendError('No subscription found', 401);
        }

        if ($user && $user->expiration_date <= $dataTime) {
            return $this->sendError('Your subscription has expired', 401);
        }

        return $next($request);
    }
}
