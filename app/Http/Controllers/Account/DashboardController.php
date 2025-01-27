<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
