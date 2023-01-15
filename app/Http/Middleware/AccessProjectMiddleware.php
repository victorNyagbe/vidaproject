<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class AccessProjectMiddleware
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
        if (!session()->get('id')) {
            session()->flush();
            return redirect()->route('guests.login');
        }

        if (session()->get('id') && !session()->get('isAuthenticated')) {
            session()->flush();
            return redirect()->route('guests.login');
        }

        return $next($request);
    }
}
