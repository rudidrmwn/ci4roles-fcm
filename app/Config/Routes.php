<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');


$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);
$routes->get('logout', 'UserController::logout');

// maker routes
$routes->match(['get','post'],"/maker/task/update", "MakerController::update",["filter"=>"auth"]);
$routes->match(['get','post'],"/maker/task/delete", "MakerController::delete",["filter"=>"auth"]);
$routes->group("maker", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "MakerController::index");
    $routes->post("/", "MakerController::save");
});

// checker routes
$routes->match(['get','post'],"/checker/task/update", "CheckerController::update",["filter"=>"auth"]);
$routes->match(['get','post'],"/checker/task/notif", "CheckerController::notification",["filter"=>"auth"]);
$routes->group("checker", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "CheckerController::index");
});

// approval routes
$routes->match(['get','post'],"/approval/task/update", "ApprovalController::update",["filter"=>"auth"]);
$routes->match(['get','post'],"/approval/task/notif", "ApprovalController::notification",["filter"=>"auth"]);
$routes->group("approval", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "ApprovalController::index");
});


//...


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
