<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) {
            return $next($request);
        }

        if (!$user->requiresPasswordChange()) {
            return $next($request);
        }

        $routeName = $request->route()?->getName();

        $isAccountRoute = is_string($routeName) && str_starts_with($routeName, 'account.');
        $isLogoutRoute = $routeName === 'logout';

        if ($isAccountRoute || $isLogoutRoute) {
            return $next($request);
        }

        return redirect()
            ->route('account.edit')
            ->with('status', 'Debes actualizar tu contrasena para continuar.');
    }
}
