<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showAuthOptions()
    {
        return view('auth.auth_options');
    }
}
