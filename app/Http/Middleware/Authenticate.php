<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (tenancy()->initialized) {
                return route('tenant.login', tenant('id'));
            }
            return route('login');
        }

        return response()->json(['message' => 'Authenticated users only.']);
    }
}