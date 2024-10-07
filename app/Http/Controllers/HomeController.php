<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // Aplica el middleware 'auth' para que solo usuarios autenticados puedan acceder
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
}
