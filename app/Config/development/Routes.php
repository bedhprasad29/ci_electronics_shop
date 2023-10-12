<?php

$routes->post('api/sign-in', 'Api\LoginController::doSignIn');
$routes->post('api/sign-up', 'Api\LoginController::doSignUp');

$routes->group('api/v1', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->post('profile/(:any)/reset', 'Profile::reset/$1');
    $routes->resource('users', ['controller' => 'UserController', 'only' => ['index', 'create', 'show', 'update', 'delete']]);
    $routes->resource('roles', ['controller' => 'RoleController', 'only' => ['index', 'create', 'show', 'update', 'delete']]);
    $routes->resource('categories', ['controller' => 'CategoryController', 'only' => ['index', 'create', 'show', 'update', 'delete']]);
    $routes->resource('products', ['controller' => 'ProductController', 'only' => ['index', 'create', 'show', 'update', 'delete']]);
});