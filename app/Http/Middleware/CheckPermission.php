<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $resourceType
     * @param  string  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $resourceType, $permission)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Si l'utilisateur n'a pas de rôle
        if (!$user->role) {
            abort(403, 'Accès non autorisé.');
        }

        // Récupérer l'ID de la ressource à partir des paramètres de la route si disponible
        $resourceId = null;
        
        // Vérifier s'il y a un identifiant de ressource dans la route
        // Par exemple, pour une route comme /videos/{video}, on peut récupérer l'ID de la vidéo
        if ($request->route($resourceType)) {
            $resourceId = $request->route($resourceType)->id;
        }

        // Vérifier si le rôle de l'utilisateur a la permission requise
        if (!$user->role->hasPermission($resourceType, $permission, $resourceId)) {
            abort(403, 'Vous n\'avez pas les permissions nécessaires pour effectuer cette action.');
        }

        return $next($request);
    }
}
