<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class ProductController extends BaseController
{
    public function index()
    {
        return view('product/index');
    }

    public function new()
    {
        return view('product/create');
    }

    public function show()
    {
        $uri = service('uri');

        return view('product/show', compact('uri'));
    }

    public function edit()
    {
        $uri = service('uri');

        return view('product/edit', compact('uri'));
    }
}
