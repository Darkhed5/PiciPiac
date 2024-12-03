<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            // Győződjünk meg róla, hogy a 'login' route helyes
            return route('login');
        }

        // Ha API hívásról van szó, a megfelelő HTTP kódot kell visszaadni
        return null;
    }
}
