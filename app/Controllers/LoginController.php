<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        return redirect()->to('login'); 
    }

    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }
}
