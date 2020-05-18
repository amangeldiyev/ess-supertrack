<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class CheckForPasswordExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ( !$user->password_changed_at || Carbon::now()->diffInDays(new Carbon($user->password_changed_at)) >= 30) {
            return redirect()->route('password.expired');
        }

        return $next($request);
    }
}
