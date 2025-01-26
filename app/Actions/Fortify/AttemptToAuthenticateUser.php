<?php

namespace App\Actions\Fortify;

use App\Concerns\Access\InteractsWithSessionGuard;
use Laravel\Fortify\Actions\AttemptToAuthenticate as FortifyAttemptToAuthenticate;
use Laravel\Fortify\Fortify;


class AttemptToAuthenticateUser extends FortifyAttemptToAuthenticate
{

    use InteractsWithSessionGuard;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if (Fortify::$authenticateUsingCallback) {
            return $this->handleUsingCustomCallback($request, $next);
        }

        $credentials = $request->only(Fortify::username(), 'password');
        $credentials['active'] = 1;

        $this->guard = $this->getSessionGuardInstance($request->role);

        if ($this->guard->attempt($credentials, $request->boolean('remember'))) {
            return $next($request);
        }

        $this->throwFailedAuthenticationException($request);
    }
}
