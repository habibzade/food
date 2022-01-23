<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use UserHelper;

class UserIsPublic
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
        if (UserHelper::isPublic()) {
            return $next($request);
        }

        return redirect()->route('admin.orders');
    }
}
