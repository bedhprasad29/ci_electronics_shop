<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class WebAuthenticationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        $userData = $session->get('user_data');

        if(isset($userData) && count($userData) > 0 && $userData['logged_in']) {
            return $request;
        } else {
            return redirect()->to('login');
        }
    }

    public function after(RequestInterface $request,
                          ResponseInterface $response,
                          $arguments = null)
    {
    }
}