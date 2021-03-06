<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/catalog/(:segment)', 'Home::category/$1');
$routes->get('/produk/(:segment)', 'Home::produk/$1');
$routes->get('/auth', 'Auth::index');
$routes->get('/register', 'Auth::fregister');
$routes->get('/buy/(:segment)', 'Cart::addCart/$1');
$routes->get('/remove/(:segment)', 'Cart::remove/$1');
$routes->get('/dashboard', 'Admin::index', ['filter' => 'authfilter']);
$routes->get('category', 'Category::index', ['filter' => 'authfilter']);
$routes->get('tag', 'Tag::index', ['filter' => 'authfilter']);
$routes->get('brands', 'Brands::index', ['filter' => 'authfilter']);
$routes->get('banners', 'Banners::index', ['filter' => 'authfilter']);
$routes->get('products', 'Products::index', ['filter' => 'authfilter']);







/**
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