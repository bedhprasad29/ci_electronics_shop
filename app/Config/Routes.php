<?php

namespace Config;
use App\Controllers\HomeController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('login', 'LoginController::login');
$routes->get('register', 'LoginController::register');
$routes->get('logout', 'ProfileController::logout');

$routes->group('u', [], function($routes) {
    $routes->get('profile', 'ProfileController::show');
    $routes->get('reset', 'ProfileController::reset');

    $routes->resource('products', [
        'controller'=> 'ProductController', 
        'only'      => ['index', 'new', 'show', 'edit', 'delete']
    ]);
    $routes->resource('categories', [
        'controller'=> 'CategoryController', 
        'only'      => ['index', 'new', 'show', 'edit', 'delete']
    ]);
    $routes->resource('roles', [
        'controller'=> 'RoleController', 
        'only'      => ['index', 'new', 'show', 'edit', 'delete']
    ]);
    $routes->resource('users', [
        'controller'=> 'UserController', 
        'only'      => ['index', 'new', 'show', 'edit', 'delete']
    ]);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}