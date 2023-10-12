<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return view('user/index');
    }

    public function new()
    {
        return view('user/create');
    }

    public function show()
    {
        $uri = service('uri');

        return view('user/show', compact('uri'));
    }

    public function edit()
    {
        $uri = service('uri');

        return view('user/edit', compact('uri'));
    }
}
