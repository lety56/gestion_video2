<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Si l'utilisateur n'a pas de rôle ou si le rôle ne correspond pas
        if (!$user->role || $user->role->nom_role !== $role) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
