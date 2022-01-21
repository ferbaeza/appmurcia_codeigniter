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
$routes->setDefaultController('LoginController');
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
if(!defined('PUBLIC_NAMESPACE')) define('PUBLIC_NAMESPACE', 'App\Controllers\PublicSection');
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


//----------------PUBLIC ROUTES-------------
$routes->group('',function($routes){
    $routes->get('/', 'LoginController::index', ['as' => "login" , 'namespace' => PUBLIC_NAMESPACE]);
    
});

//----------------PRIVATE ROUTES-------------
//$routes->group('admin',function($routes){
    //$routes->get('home_admin', 'HomeController::index', ['as' => "home_admin" , 'namespace' => ADMIN_NAMESPACE]);
    //$routes->get('usuarios', 'UsuariosController::index', ['as' => "usuarios", 'namespace' => ADMIN_NAMESPACE]);
    //$routes->get('festivales', 'FestivalesController::index', ['as' => "festivales" , 'namespace' => ADMIN_NAMESPACE]);
//});

//--------------------------------------------------------------------
// Command Routes
//-------------------------------------------------------------------
$routes->group('commands', function($routes){
    $routes->cli('news', 'NewsCommand::index', ['namespace'=> COMMAND_NAMESPACE]);
    $routes->cli('delnews', 'NewsCommand::deletetable', ['namespace'=> COMMAND_NAMESPACE]);
    $routes->cli('stations', 'StationsCommand::index',['namespace' => COMMAND_NAMESPACE] ); 
    $routes->cli('delstations', 'StationsCommand::deletetable',['namespace' => COMMAND_NAMESPACE] ); 
    $routes->cli('videos', 'VideosCommand::index', ['namespace'=> COMMAND_NAMESPACE]);
    $routes->cli('delvideos', 'VideosCommand::deletetable', ['namespace'=> COMMAND_NAMESPACE]);
    $routes->cli('weather', 'WeatherCommand::index', ['namespace'=> COMMAND_NAMESPACE]);
    $routes->cli('delweather', 'WeatherCommand::deletetable', ['namespace'=> COMMAND_NAMESPACE]);

});



//--------------------------------------------------------------------
// Rest Routes
//-------------------------------------------------------------------
$routes->group('rest',function($routes){
    //-----------------Restaurants---------------------//
    $routes->get('restaurants', 'RestaurantRestController::index',['namespace' => REST_NAMESPACE] ); 
    $routes->get('restaurants/(:any)', 'RestaurantRestController::index/$1',['namespace' => REST_NAMESPACE] ); 
    //$routes->delete('restaurants', 'RestaurantRestController::deleteCategory',['namespace' => REST_NAMESPACE] ); 
    //$routes->post('restaurants', 'RestaurantRestController::modify',['namespace' => REST_NAMESPACE] ); 
    //-------------------------------------------------------------------
    //-----------------GasStations---------------------//
    $routes->get('stations', 'GasStationRestController::index',['namespace' => REST_NAMESPACE] ); 
    $routes->get('stations/(:any)', 'GasStationRestController::index/$1',['namespace' => REST_NAMESPACE] ); 
    //$routes->delete('stations', 'GasStationRestController::deleteCategory',['namespace' => REST_NAMESPACE] ); 
    //$routes->post('stations', 'GasStationRestController::modify',['namespace' => REST_NAMESPACE] ); 
    //-------------------------------------------------------------------
    //-----------------Wheather---------------------//
    $routes->get('weather', 'WeatherRestController::index',['namespace' => REST_NAMESPACE] ); 
    $routes->get('weather/(:any)', 'WeatherRestController::index/$1',['namespace' => REST_NAMESPACE] ); 
    //$routes->delete('weather', 'WeatherRestController::deleteCategory',['namespace' => REST_NAMESPACE] ); 
    //$routes->post('weather', 'WheatherRestController::modify',['namespace' => REST_NAMESPACE] );
    //-------------------------------------------------------------------
    //-----------------Review---------------------//
    $routes->get('reviewall', 'ReviewRestController::index',['namespace' => REST_NAMESPACE] ); 
    $routes->get('reviewall/(:any)', 'ReviewRestController::index/$1',['namespace' => REST_NAMESPACE] ); 
    $routes->get('reviewrestauranteid', 'ReviewRestController::restaId',['namespace' => REST_NAMESPACE] ); 
    $routes->get('reviewrestauranteid/(:any)', 'ReviewRestController::restaId/$1',['namespace' => REST_NAMESPACE] ); 
    $routes->get('reviewid/(:any)', 'ReviewRestController::reviewId/$1',['namespace' => REST_NAMESPACE] ); 
    $routes->get('reviewid/', 'ReviewRestController::reviewId',['namespace' => REST_NAMESPACE] ); 
    $routes->get('reviewbymailbyrestid/(:any)/(:any)', 'ReviewRestController::bymailandId/$1/$2',['namespace' => REST_NAMESPACE] ); 
    $routes->post('reviewbymailbyrestid', 'ReviewRestController::editCreateReview',['namespace' => REST_NAMESPACE] ); 
    //$routes->get('reviewbymailbyrestid', 'ReviewRestController::bymailandId',['namespace' => REST_NAMESPACE] ); 
    // eldiariogourmet@mail.com  2
    $routes->delete('deletereview', 'ReviewRestController::deleteReview',['namespace' => REST_NAMESPACE] ); 
    //$routes->post('review', 'ReviewRestController::modify',['namespace' => REST_NAMESPACE] );
    //-------------------------------------------------------------------
    //-----------------News---------------------//
    $routes->get('news', 'NewsRestController::index',['namespace' => REST_NAMESPACE] ); 
    $routes->get('news/(:any)', 'NewsRestController::index/$1',['namespace' => REST_NAMESPACE] ); 
    //$routes->delete('news', 'NewsRestController::deleteCategory',['namespace' => REST_NAMESPACE] ); 
    //$routes->post('news', 'NewsRestController::modify',['namespace' => REST_NAMESPACE] );
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
