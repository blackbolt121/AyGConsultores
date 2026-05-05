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

        // We allow GET pages to render, but we block mutating requests until the password is updated.
        $routeName = $request->route()?->getName();
        $isLogoutRoute = $routeName === 'logout';
        $isPasswordUpdateRoute = $routeName === 'account.password.update';

        if ($request->isMethod('get') || $request->isMethod('head')) {
            return $next($request);
        }

        if ($isLogoutRoute || $isPasswordUpdateRoute) {
            return $next($request);
        }

        return redirect()
            ->back()
            ->with('status', 'Debes actualizar tu contrasena para continuar.');
    }
}
