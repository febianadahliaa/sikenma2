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

$routes->get('/auth/login', 'Auth::login');

// $routes->group('', ['filter' => 'authFilter'], function ($routes) {
$routes->get('/', 'Dashboard::index');

// Admin-Mitra
$routes->get('/mitra-list', 'Admin\Mitra::index');
$routes->get('/mitra-add', 'Admin\Mitra::addMitra');
$routes->post('/mitra-save', 'Admin\Mitra::saveMitra');
$routes->get('/mitra-detail/(:num)', 'Admin\Mitra::mitraDetail/$1');
$routes->get('/mitra-edit/(:num)', 'Admin\Mitra::editMitra/$1');
$routes->post('/mitra-update', 'Admin\Mitra::updateMitra');
$routes->delete('/mitra-delete/(:num)', 'Admin\Mitra::deleteMitra/$1');
// Admin-Users
$routes->get('/users-list', 'Admin\Users::index');
$routes->get('/users-add', 'Admin\Users::addUser');
$routes->post('/users-save', 'Admin\Users::saveUser');
$routes->get('/users-detail/(:num)', 'Admin\Users::userDetail/$1');
$routes->get('/users-edit/(:num)', 'Admin\Users::editUser/$1');
$routes->post('/users-update', 'Admin\Users::updateUser');
$routes->post('/users-reset-password/(:num)', 'Admin\Users::resetPassword/$1');
$routes->delete('/users-delete/(:num)', 'Admin\Users::deleteUser/$1');
// Admin-Survey-SurveyMaster
$routes->get('/survey-list', 'Admin\Survey::index');
$routes->get('/survey-add', 'Admin\Survey::addSurvey');
$routes->post('/survey-save', 'Admin\Survey::saveSurvey');
$routes->get('/survey-edit/(:num)', 'Admin\Survey::editSurvey/$1');
$routes->post('/survey-update', 'Admin\Survey::updateSurvey');
$routes->delete('/survey-delete/(:num)', 'Admin\Survey::deleteSurvey/$1');
$routes->get('/survey-master-add', 'Admin\Survey::addSurveyMaster');
$routes->post('/survey-master-save', 'Admin\Survey::saveSurveyMaster');
$routes->get('/survey-master-edit/(:num)', 'Admin\Survey::editSurveyMaster/$1');
$routes->post('/survey-master-update', 'Admin\Survey::updateSurveyMaster');
$routes->delete('/survey-master-delete/(:num)', 'Admin\Survey::deleteSurveyMaster/$1');

$routes->get('/track-record-summary', 'Mitra\TrSummary::index');
$routes->get('/track-record-entry', 'Mitra\TrackRecord::index');
// });

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
