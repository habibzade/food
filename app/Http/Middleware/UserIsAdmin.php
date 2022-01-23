<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use UserHelper;

class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (UserHelper::isAdmin()) {
            return $next($request);
        }

        // If user is not an admin
        return redirect()->route('home');
    }
}
