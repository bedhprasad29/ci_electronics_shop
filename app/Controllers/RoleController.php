<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RoleController extends BaseController
{
    public function index()
    {
        return view('role/index');
    }

    public function new()
    {
        return view('role/create');
    }

    public function show()
    {
        $uri = service('uri');

        return view('role/show', compact('uri'));
    }

    public function edit()
    {
        $uri = service('uri');

        return view('role/edit', compact('uri'));
    }
}
