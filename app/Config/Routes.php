<?php

namespace Config;

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
$routes->get('/', 'Home::Login');

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


//Custom Routing
$routes->post('/user_login','Home::User_login');
$routes->get('/dashboard','Home::Index');
$routes->get('/logout','Home::Logout');
$routes->get('/add_employee','Home::AddEmploye');
$routes->post('/add_employee_post',"Home::AddEmployePost");
$routes->get('/add_employee/(:num)','Home::AddEmploye/$1');
$routes->post('/update_employee','Home::UpdateEmploye');

//Bundle Master Routing
$routes->get('/bundle_master','Home::BundleMaster');
$routes->post('/bundle_master_temp_post','Home::BundleMasterTempPost');
$routes->add('/bundle_master/(:num)','Home::BundleMaster/$1');
$routes->add('/bundle_master_final_post','Home::BundleMasterFinalPost');