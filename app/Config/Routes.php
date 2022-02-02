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
$routes->group('/',function($routes){
    $routes->get('', 'LoginController::index', ['as' => "login" , 'filter'=>'auth', 'namespace' => PUBLIC_NAMESPACE]);
    $routes->post('/login/save', 'LoginController::verify', ['as' => "verify_login" , 'namespace' => PUBLIC_NAMESPACE]);
    $routes->get('/logout', 'LogoutController::index', ['as' => "logout" , 'namespace' => PUBLIC_NAMESPACE]);
});

//----------------PRIVATE ROUTES-------------
$routes->group('admin',function($routes){
    $routes->get('home_admin', 'UserAdminController::index', ['as' => "home_admin" ,'filter'=>'auth_private', 'namespace' => ADMIN_NAMESPACE]);

    //---------RESTAURANTS---------
    $routes->get('restaurantes', 'RestaurantesController::index', ['as' => "restaurantes", 'namespace' => ADMIN_NAMESPACE]);
    $routes->post('restaurantes_data', 'RestaurantesController::getRestaurantesData',['as'=>'restaurantes_data','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data
    $routes->get('restaurantes_form', 'RestaurantesController::newEditRestaurante', ['as' => 'restaurantes_form','filter'=>'auth_private' , 'namespace' => ADMIN_NAMESPACE]);
    $routes->get('restaurantes_form/(:any)', 'RestaurantesController::newEditRestaurante/$1', ['filter'=>'auth_private','namespace' => ADMIN_NAMESPACE]);
    $routes->post('save_restaurante', 'RestaurantesController::saveRestaurante',['as'=>'save_restaurante','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );
    $routes->delete('restaurante_delete', 'RestaurantesController::deleteRestaurante',['as'=>'restaurante_delete','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );
    
    //---------NEWS---------
    $routes->get('news', 'NewsController::index', ['as' => "news",'filter'=>'auth_private', 'namespace' => ADMIN_NAMESPACE]);
    $routes->post('news_data', 'NewsController::getNewsData',['as'=>'news_data','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data
    $routes->get('news_show/(:any)', 'NewsController::showNewsData/$1',['filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data

    //---------GasStation---------
    $routes->get('gasstation', 'GasController::index', ['as' => "gasstation",'filter'=>'auth_private', 'namespace' => ADMIN_NAMESPACE]);
    $routes->post('gas_data', 'GasController::getGasData',['as'=>'gas_data','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data
    $routes->get('gas_show/(:any)', 'GasController::showGasData/$1',['filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data
   
    //---------Reviews---------
    $routes->get('review', 'ReviewController::index', ['as' => "review",'filter'=>'auth_private', 'namespace' => ADMIN_NAMESPACE]);
    $routes->post('review_data', 'ReviewController::getReviewData',['as'=>'review_data','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data
    $routes->get('review_form', 'ReviewController::newEditReview', ['as' => 'review_form' ,'filter'=>'auth_private', 'namespace' => ADMIN_NAMESPACE]);
    $routes->get('review_form/(:any)', 'ReviewController::newEditReview/$1', ['filter'=>'auth_private','namespace' => ADMIN_NAMESPACE]);
    $routes->post('save_review', 'ReviewController::saveReview',['as'=>'save_review','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );
    $routes->delete('review_delete', 'ReviewController::deleteReview',['as'=>'review_delete','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );
    
    //---------Videos---------
    $routes->get('videos', 'VideosController::index', ['as' => "videos",'filter'=>'auth_private', 'namespace' => ADMIN_NAMESPACE]);
    $routes->post('videos_data', 'VideosController::getVideosData',['as'=>'videos_data','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data
    $routes->get('videos_show/(:any)', 'VideosController::showVideosData/$1',['filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data

    //---------Weather---------
    $routes->get('weather', 'WeatherController::index', ['as' => "weather", 'filter'=>'auth_private','namespace' => ADMIN_NAMESPACE]);
    $routes->post('weather_data', 'WeatherController::getWeatherData',['as'=>'weather_data','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data

    //---------Users---------
    $routes->get('users', 'UsersController::index', ['as' => "users", 'filter'=>'auth_private','namespace' => ADMIN_NAMESPACE]);
    $routes->post('users_data', 'UsersController::getUsersData',['as'=>'users_data','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data
    $routes->get('users_form', 'UsersController::newEditUser', ['as' => 'users_form' , 'filter'=>'auth_private','namespace' => ADMIN_NAMESPACE]);
    $routes->get('users_form/(:any)', 'UsersController::newEditUser/$1', ['filter'=>'auth_private','namespace' => ADMIN_NAMESPACE]);
    $routes->post('save_users', 'UsersController::saveUser',['as'=>'save_users','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );
    $routes->delete('users_delete', 'UsersController::deleteUser',['as'=>'users_delete','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );
    
    //---------Roles---------
    $routes->get('roles', 'RolesController::index', ['as' => "roles",'filter'=>'auth_private', 'namespace' => ADMIN_NAMESPACE]);
    $routes->post('roles_data', 'RolesController::getRolesData',['as'=>'roles_data','filter'=>'auth_private','namespace' => ADMIN_NAMESPACE] );  //Get Data


});

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
    $routes->get('allreviews', 'ReviewRestController::all',['namespace' => REST_NAMESPACE] ); 
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

    //-----------------videos---------------------//
    $routes->get('videos', 'VideosRestController::index',['namespace' => REST_NAMESPACE] ); 
    $routes->get('videos/(:any)', 'VideosRestController::index/$1',['namespace' => REST_NAMESPACE] ); 
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
