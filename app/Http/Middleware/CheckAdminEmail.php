<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckAdminEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Obtiene el correo del usuario autenticado
            $email = Auth::user()->email;

            // Si el correo es el del administrador, permite el acceso
            $white_list = ['admin@aygconsultores.com.mx', 'rgo1999@hotmail.com'];

            if (in_array($email, $white_list, true)) {
                return $next($request);
            }
        }

        // Si no es admin o no está autenticado, redirige al index del sitio
        return redirect('/');
    }
}
