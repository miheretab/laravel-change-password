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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// FIXME: This route is only here as an example!
// It must be replaced with a proper route to a controller/action with appropriate middleware for authentication
Route::get('/password/change', function () {
    return view('auth.passwords.change',
        [
            'mode' => 'edit',       // show for readonly, edit to be able to change fields
            'formAction' => '/password/change'
        ]);
});