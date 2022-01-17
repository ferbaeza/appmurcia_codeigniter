<?php

namespace Config;

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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * NameSpaces
 * --------------------------------------------------------------------
 */
if(!defined('ADMIN_NAMESPACE')) define('ADMIN_NAMESPACE', 'App\Controllers\Admin');
if(!defined('REST_NAMESPACE')) define('REST_NAMESPACE', 'App\Controllers\Rest');
if(!defined('COMMAND_NAMESPACE')) define('COMMAND_NAMESPACE', 'App\Controllers\Command');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');




//--------------------------------------------------------------------
// Rest Routes
//-------------------------------------------------------------------
$routes->group('rest',function($routes){
    //-----------------Restaurants---------------------//
    $routes->get('restaurants', 'RestaurantRestController::index',['namespace' => REST_NAMESPACE] ); 
    $routes->get('restaurants/(:any)', 'RestaurantRestController::index/$1',['namespace' => REST_NAMESPACE] ); 
    //$routes->delete('restaurants', 'RestaurantRestController::deleteCategory',['namespace' => REST_NAMESPACE] ); 
    //$routes->post('restaurants', 'RestaurantRestController::modify',['namespace' => REST_NAMESPACE] ); 
    //-----------------GasStations---------------------//
    $routes->get('stations', 'GasStationRestController::index',['namespace' => REST_NAMESPACE] ); 
    $routes->get('stations/(:any)', 'GasStationRestController::index/$1',['namespace' => REST_NAMESPACE] ); 
    //$routes->delete('stations', 'GasStationRestController::deleteCategory',['namespace' => REST_NAMESPACE] ); 
    //$routes->post('stations', 'GasStationRestController::modify',['namespace' => REST_NAMESPACE] ); 
    
});
//--------------------------------------------------------------------
// Command Routes
//-------------------------------------------------------------------
// $routes->group('commands',function($routes){
//     $routes->cli('comandouno', 'Scripts::comandoUno',['namespace' => COMMAND_NAMESPACE] ); 
//     $routes->cli('comandodos', 'Scripts::comandoDos',['namespace' => COMMAND_NAMESPACE] ); 
//     $routes->cli('comandotres', 'Scripts::comandoTres',['namespace' => COMMAND_NAMESPACE] ); 
// });
//--------------------------------------------------------------------

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
