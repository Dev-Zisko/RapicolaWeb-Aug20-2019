<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('apiregister', 'CustomerController@r_customer')->name('apiregister');

Route::post('apilogin', 'CustomerController@check_login')->name('apiregister');

Route::post('apidata', 'CustomerController@get_data')->name('apidata');

Route::post('apisearch', 'CustomerController@search_profile')->name('apisearch');

Route::post('apiprofile', 'CustomerController@edit_profile')->name('apiprofile');

Route::post('apilogout', 'CustomerController@logout')->name('apilogout');

Route::post('apienterqueue', 'CustomerController@enterqueue')->name('apienterqueue');

Route::post('apichangestatus', 'CustomerController@changestatus')->name('apichangestatus');

Route::post('apiexitqueue', 'CustomerController@exitqueue')->name('apiexitqueue');

Route::post('apigetqueue', 'CustomerController@get_queue')->name('apigetqueue');

Route::post('apigetposition', 'CustomerController@get_position')->name('apigetposition');

Route::post('apicheckticket', 'CustomerController@check_ticket')->name('apicheckticket');

Route::post('apicheckstorage', 'CustomerController@check_storage')->name('apicheckstorage');

Route::post('apilocation', 'CustomerController@geolocation')->name('apilocation');

Route::post('apitimes', 'CustomerController@save_times')->name('apitimes');