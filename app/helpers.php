<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (!function_exists('principal')) {
    /**
     * Extracts or gets the current authenticated user.
     * 
     * @param string $guard 
     * [optional] The authentication guard to be used to extract the 
     * authenticated user.
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function principal(string $guard = null)
    {
        if ($guard) return Auth::guard($guard)->user();
        foreach (array_keys(config('auth.guards')) as $guard) {
            if($guard === 'sanctum') continue;
            if ($user = Auth::guard($guard)->user()) {
                return $user;
            }
        }
    }
}


if (!function_exists('clinic')) {
    /**
     * Get a key from the current tenant's storage.
     * If no value is provided as a key, 
     * this function returns the current tenant object. 
     * @param string $key [optional] The tenant key to retrieve. 
     * @return mixed|null
     */
    function clinic($key = null)
    {
        return tenant($key);
    }
}
