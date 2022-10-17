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

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'users' => 'UserController',
    'blogs' => 'BlogController'
]);

Route::put('/edit_profile', 'UserController@editProfile')->name('edit_profile')->middleware('auth');
Route::get('/supervisors', 'supervisorController@index')->name('supervisor.index')->middleware('auth');
