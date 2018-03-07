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

Route::get('/', function () {
    $trends =  Twitter::getTrendsAvailable();
    $locations="\$locations = [";
    foreach ($trends as $key => $value) {
        $locations .= "'".strtolower($value->name)."'=>".$value->woeid.",";
    }
    $locations .= "]";
    return $locations;
});

Route::get('/berlin', function () {
    return Twitter::getTrendsPlace(['id' => 638242]);
});

Route::get('/webhook', 'MessengerController@webhook');
Route::post('/webhook', 'MessengerController@webhook_post');