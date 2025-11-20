<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DashboardRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         if (Auth::check()) {
            // Obtiene el correo del usuario autenticado
            $email = Auth::user()->email;

            // Si el correo es el del administrador, permite el acceso
            $white_list = ['admin@aygconsultores.com.mx'];

            if (in_array($email, $white_list, true)) {
                return redirect('/admin/courses');
            }

            return $next($request);
        }

        return redirect('/login');
        
    }
}
