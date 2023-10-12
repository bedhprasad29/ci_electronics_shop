<?php

function getCurrentUser($request)
{
    $userData = $request->getHeaderLine('user_data');
    list($idString, $emailString, $roleIdString) = explode(", ", $userData);

    $user = [];
    $user['id']     = explode("=", $idString)[1];
    $user['email']  = explode("=", $emailString)[1];
    $user['role_id']= explode("=", $roleIdString)[1];
    return $user;
}

function getMenu()
{
    $userData = session('user_data');

    if (isset($userData)) {
        $roleId = $userData['role_id'];

        $db = db_connect();
        $builder = $db->table("menus");
        $builder->select('menus.name, menus.uri_path');
        $builder->join('menu_permissions mp', 'mp.menu_id = menus.id', 'left');
        $builder->where('mp.role_id', $roleId);
        $builder->where('menus.main_menu', 'Y');
        $builder->orderBy('menus.display_order', 'ASC');

        return $builder->get()->getResult();
    }

    return [];
}
