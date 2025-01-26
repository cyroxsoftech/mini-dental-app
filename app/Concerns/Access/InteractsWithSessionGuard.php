<?php

namespace App\Concerns\Access;

use Illuminate\Support\Facades\Auth;

trait InteractsWithSessionGuard
{

    /**
     * Get the session auth guard by name
     * 
     * @param $guard Session guard name to get.
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function getSessionGuardInstance(string $guard = null)
    {
        $guards =  array_keys(config('auth.guards'));

        if (in_array($guard, $guards)) {
            return Auth::guard($guard);
        }

        return Auth::guard();
    }

    /**
     * Get the current used session auth guard
     * 
     * @return string
     */
    public function getCurrentSessionGuardName()
    {
        $guards = array_keys(config('auth.guards'));

        return collect($guards)->first(function ($guard) {
            return auth()->guard($guard)->check();
        });
    }
}
