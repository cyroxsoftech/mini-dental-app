<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as FortifyAuthenticatedSessionController;
use App\Http\Responses\LogoutResponse as UserLogoutResponse;
use App\Actions\Fortify\AttemptToAuthenticateUser;
use App\Http\Responses\LoginResponse;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Concerns\Access\InteractsWithSessionGuard;
use Illuminate\Validation\Rule;


class AuthenticatedSessionController extends FortifyAuthenticatedSessionController
{

    use InteractsWithSessionGuard;

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        $validated = $request->validate([
            'role' => ['required', 'string', Rule::in(array_keys(config('auth.guards')))],
        ]);

        $locale = null;

        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
        }

        $this->guard = $this->getSessionGuardInstance($validated['role']);

        return $this->loginPipeline($request)->then(function ($request) use ($locale) {
            if (!empty($locale)) {
                $user = $this->guard->user();
                if ((!app()->isLocale($user->locale)) && in_array($locale, config('app.supported_locales'))) {
                    $user->locale = $locale;
                    $user->save();
                }
            }
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticateUser::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {

        $this->guard = $this->getSessionGuardInstance(
            $this->getCurrentSessionGuardName()
        );

        $this->guard->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return app(UserLogoutResponse::class);
    }
}
