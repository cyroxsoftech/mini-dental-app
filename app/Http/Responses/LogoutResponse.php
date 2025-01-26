<?php

namespace App\Http\Responses;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;


class LogoutResponse implements LogoutResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $routeParams = [
            'tenant' => clinic('id'),
        ];

        $role = $request->query('role') ?: session('previousUserRole');
        $lang = session('locale');
        $routeParams['role'] = $role;
        if ($lang) $routeParams['lang'] = $lang;

        return $request->wantsJson()
            ? new JsonResponse('', 204)
            : redirect()->route('clinic.login', $routeParams)
            ->with('success', 'You have successfully logged out.');
    }
}
