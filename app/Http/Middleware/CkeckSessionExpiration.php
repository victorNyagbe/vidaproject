<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Events\SessionExpired;
use Illuminate\Support\Facades\Auth;

class CkeckSessionExpiration
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
        if (Auth::check() && $request->session()->has('lastActivity')) {
            $lastActivity = $request->session()->get('lastActivity');
            $currentTime = time();
            $sessionTimeout = config('session.lifetime') * 10; // Durée de la session en secondes

            if ($currentTime - $lastActivity > $sessionTimeout) {
                // La session a expiré en raison du timeout
                // Déclencher un événement pour gérer cette expiration
                event(new SessionExpired(Auth::id())); // Remplacez par l'événement que vous créez
            }
        }

        // Mettre à jour le timestamp de la dernière activité à chaque requête
        session()->put('lastActivity', time());
        return $next($request);
    }
}
