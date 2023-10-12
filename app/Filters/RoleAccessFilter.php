<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class RoleAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $roleId = session('user_data')['role_id'];

        $uri = service('uri');
        $url = $uri->getSegment(2);

        helper('common');
        $menus = getMenu();

        $menuArr = ['profile', 'reset'];
        foreach ($menus as $accessibleMenu) {
            $menuArr[] = $accessibleMenu->uri_path;
        }

        if (in_array($url, $menuArr)) {
            return $request;
        }

        return redirect()->to('login');
    }

    public function after(RequestInterface $request,
                          ResponseInterface $response,
                          $arguments = null)
    {
    }
}