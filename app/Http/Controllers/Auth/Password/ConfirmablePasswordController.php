<?php

namespace App\Http\Controllers\Auth\Password;

use Illuminate\Http\Request;
use Laravel\Fortify\Actions\ConfirmPassword;
use Laravel\Fortify\Contracts\FailedPasswordConfirmationResponse;
use Laravel\Fortify\Contracts\PasswordConfirmedResponse;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController as FortifyController;


class ConfirmablePasswordController extends FortifyController
{
    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(Request $request)
    {
        $confirmed = app(ConfirmPassword::class)(
            $this->guard,
            $request->user(),
            $request->input('password')
        );

        if ($confirmed) {
            $request->session()->put('tenant.auth.password_confirmed_at', time());
        }

        return $confirmed
            ? app(PasswordConfirmedResponse::class)
            : app(FailedPasswordConfirmationResponse::class);
    }
}
