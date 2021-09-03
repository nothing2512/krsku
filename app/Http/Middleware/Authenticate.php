<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string[] ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!session()->isStarted()) session()->start();

        $requireAuth = $guards[0] == "true";
        $user = user();

        if ($requireAuth && $user == null) {
            $oldRoute = $request->route()->getName();
            $oldParameter = $request->route()->parameters();

            session()->flash("route", route($oldRoute, $oldParameter));

            return redirect()->route("login");
        } else if (!$requireAuth && $user != null) return redirect()->route("dashboard");

        return $next($request);
    }
}
