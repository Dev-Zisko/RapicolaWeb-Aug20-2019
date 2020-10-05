<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'PageController@view_index')->name('index');

Route::get('/index', 'PageController@view_index')->name('index');

Route::get('/sublogin', 'PageController@view_sublogin')->name('sublogin');

Route::post('/sublogin', 'PageController@check_login')->name('sublogin');

Route::get('/subregister', 'PageController@view_subregister')->name('subregister');

Route::post('/subregister', 'CustomerController@sr_customer')->name('subregister');

Route::group(['middleware'=>'auth'], function(){

	Route::get('/home', 'HomeController@view_dashboard')->name('dashboard');

	Route::get('/dashboard', 'HomeController@view_dashboard')->name('dashboard');

	Route::get('/dashboards', 'HomeController@view_dashboards')->name('dashboards');

	Route::get('/dashboardrs', 'HomeController@view_dashboardrs')->name('dashboardrs');

	Route::post('/dashboardrs', 'SubsidiaryController@r_subsidiary')->name('dashboardrs');

	Route::get('/dashboardus/{id}', 'HomeController@view_dashboardus')->name('dashboardus');

	Route::post('/dashboardus/{id}', 'SubsidiaryController@u_subsidiary')->name('dashboardus');

	Route::get('/dashboardds/{id}', 'HomeController@view_dashboardds')->name('dashboardds');

	Route::post('/dashboardds/{id}', 'SubsidiaryController@d_subsidiary')->name('dashboardds');

	Route::get('/dashboardlc', 'HomeController@view_dashboardlc')->name('dashboardlc');

	Route::get('/dashboardc/{id}', 'HomeController@view_dashboardc')->name('dashboardc');

	Route::get('/dashboardrc/{id}', 'HomeController@view_dashboardrc')->name('dashboardrc');

	Route::post('/dashboardrc/{id}', 'CashierController@r_cashier')->name('dashboardrc');

	Route::get('/dashboarduc/{id}', 'HomeController@view_dashboarduc')->name('dashboarduc');

	Route::post('/dashboarduc/{id}', 'CashierController@u_cashier')->name('dashboarduc');

	Route::get('/dashboarddc/{id}', 'HomeController@view_dashboarddc')->name('dashboarddc');

	Route::post('/dashboarddc/{id}', 'CashierController@d_cashier')->name('dashboarddc');

	Route::get('/dashboardlq', 'HomeController@view_dashboardlq')->name('dashboardlq');

	Route::get('/dashboardq/{id}', 'HomeController@view_dashboardq')->name('dashboardq');

});

//ESTAS RUTAS ESTAN VALIDADAS CON SEGURIDAD DE TICKETS

Route::get('/subdashboard/{id}', 'PageController@view_subdashboard')->name('subdashboard');

Route::get('/subdashboardc/{id}', 'PageController@view_subdashboardc')->name('subdashboardc');

Route::get('/subdashboardrc/{id}', 'PageController@view_subdashboardrc')->name('subdashboardrc');

Route::post('/subdashboardrc/{id}', 'CashierController@sr_cashier')->name('subdashboardrc');

Route::get('/subdashboarduc/{id}/{uid}', 'PageController@view_subdashboarduc')->name('subdashboarduc');

Route::post('/subdashboarduc/{id}/{uid}', 'CashierController@su_cashier')->name('subdashboarduc');

Route::get('/subdashboarddc/{id}/{uid}', 'PageController@view_subdashboarddc')->name('subdashboarddc');

Route::post('/subdashboarddc/{id}/{uid}', 'CashierController@sd_cashier')->name('subdashboarddc');

Route::get('/subdashboardq/{id}', 'PageController@view_subdashboardq')->name('subdashboardq');

Route::get('/restart/{id}', 'QueueController@srestart_queue')->name('restart');

Route::get('/tokelogout/{id}', 'TicketController@logout')->name('restart');

Route::get('/subcashierq/{id}', 'PageController@view_subcashierq')->name('subcashierq');

Route::get('/subrestart/{id}', 'QueueController@crestart_queue')->name('subrestart');

Route::get('/nextqueue/{id}', 'CashierController@next_queue')->name('nextqueue');

Route::get('/nowqueue/{id}', 'CashierController@now_queue')->name('nowqueue');

Route::get('/realtime/{id}', 'CashierController@realtime')->name('realtime');

Route::get('/error', 'PageController@view_error')->name('error');

Route::get('404', function(){
    abort(404);
});