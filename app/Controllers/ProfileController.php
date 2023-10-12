<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User as UserModel;

class ProfileController extends BaseController
{
    public function show()
    {
        $user = session('user_data');

        return view('profile/show', compact('user'));
    }

    public function reset()
    {
        $user = session('user_data');

        return view('profile/reset', compact('user'));
    }

    public function logout()
    {
        $session = session();
        $session->remove('user_data');
        
        return redirect()->to('login');
    }
}
