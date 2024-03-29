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
$routes->setDefaultController('User');
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
$routes->get('/', 'User::index');
$routes->delete('/admin/(:num)', 'Admin::hapus_anggota/$1');
$routes->get('/kartu_anggota/(:any)', 'Admin::kartu_anggota/$1');
$routes->delete('/admin/pendaftaran/(:num)', 'Admin::hapus_calon_anggota/$1');
$routes->delete('/admin/donasi/(:num)', 'Admin::hapus_donasi/$1');
$routes->delete('/admin/absen/(:num)', 'Admin::hapus_absen/$1');
// $routes->get('/login', 'login::index');
// $routes->post('/admin/tambah_agenda', 'admin::tambah_agenda');
// $routes->get('login/verifikasi/(:any)', 'login::verifikasi/$1');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
