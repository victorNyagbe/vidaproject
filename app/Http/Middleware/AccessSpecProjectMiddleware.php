<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class AccessSpecProjectMiddleware
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
        $currentUrl = url()->current();

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
