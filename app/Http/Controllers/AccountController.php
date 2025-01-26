<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $allowedGuards = implode(',', array_keys(config('auth.guards')));
        $this->middleware(['auth:' . $allowedGuards]);
    }

    public function index(Request $request){
        return view('account.dashboard');
    }
}
