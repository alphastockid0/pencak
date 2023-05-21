<?php

namespace Config;


// use App\Libraries\WebSocket;
// use Ratchet\Http\HttpServer;
// use Ratchet\Server\IoServer;
// use Ratchet\WebSocket\WsServer;
// use React\EventLoop\Factory as ReactFactory;
// use React\Socket\Server as Reactor;


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->get('/dashboard', 'Home::dashboard');
// juri
$routes->get('/juri', 'Juri::index');
$routes->post('/juri', 'Juri::index');
$routes->post('/juri/input', 'Juri::input');
$routes->get('/juri/start', 'Juri::start');
// dewan
$routes->get('/dewan', 'Dewan::dewan');
$routes->post('/dewan', 'Dewan::dewan');
// kp
$routes->get('/kp', 'Kp::kp');
$routes->post('/kp', 'Kp::kp');
// public
$routes->get('/public', 'Public::public');

// var
$routes->get('/var', 'Var::var');

// socket
$routes->group('chat', function ($routes) {
    $routes->get('/', 'ChatController::index');
});


$routes->get('/cek', 'AuthNilai::auth');



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
