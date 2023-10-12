<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CategoryController extends BaseController
{
    public function index()
    {
        return view('category/index');
    }

    public function new()
    {
        return view('category/create');
    }

    public function show()
    {
        $uri = service('uri');

        return view('category/show', compact('uri'));
    }

    public function edit()
    {
        $uri = service('uri');

        return view('category/edit', compact('uri'));
    }
}
