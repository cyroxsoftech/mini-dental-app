<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        static::registerViewResponseBindings();

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }

    /**
     * Register the authentication view response bindings.
     */
    public static function registerViewResponseBindings()
    {
        Fortify::loginView(function (Request $request) {
            if ($request->route()->named('tenant.login')) {
                return view('auth.login');
            }
            return view('central.auth.login');
        });

        Fortify::registerView(function (Request $request) {
            if ($request->route()->named('tenant.register')) {
                return view('auth.register');
            }
            return view('central.auth.register');            
        });

        Fortify::requestPasswordResetLinkView(function (Request $request) {
            if ($request->route()->named('tenant.password.request')) {
                return view('auth.password.email');
            }
            return view('central.auth.password.email');
        });

        Fortify::resetPasswordView(function (Request $request) {
            if ($request->route()->named('tenant.password.reset')) {
                return view('auth.password.reset', [
                    'token' => $request->route('token'),
                    'email' => $request->query('email'),
                ]);
            }
            return view('central.auth.password.reset', [
                'guard' => $request->route('guard'),
                'token' => $request->route('token'),
                'email' => $request->query('email'),
            ]);
        });

        Fortify::verifyEmailView(function (Request $request) {
            if ($request->route()->named('tenant.verification.notice')) {
                return view('auth.verify');
            }
            return view('central.auth.verify');
        });

        Fortify::confirmPasswordView(function (Request $request) {
            if ($request->route()->named('tenant.password.confirm-request')) {
                return view('auth.password.confirm');
            }
            return view('central.auth.password.confirm');
        });
    }
}
