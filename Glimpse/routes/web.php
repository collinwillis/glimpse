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


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adminHome', 'HomeController@adminHome')->name('adminHome');

Route::get('/userHome', 'HomeController@userHome')->name('userHome');

Route::get('/register', 'HomeController@register')->name('register');

Route::get('/login', 'HomeController@login')->name('login');

Route::post('/doRegister', 'UserController@register')->name('doRegister');

Route::post('/doLogin', 'UserController@login')->name('doLogin');

Route::get('/profile', 'UserController@profile')->name('profile');

Route::post('/updateProfile', 'UserController@updateProfile')->name('updateProfile');

Route::post('/updateAdminProfile', 'UserController@updateAdminProfile')->name('updateAdminProfile');

Route::get('/admin', 'UserController@admin')->name('admin');

Route::get('/adminProfile', 'UserController@adminProfile')->name('adminProfile');

Route::get('/editUser/{username}', 'UserController@editUser')->name('editUser');

Route::post('/onEditUser', 'UserController@onEditUser')->name('onEditUser');

Route::get('/deleteUser/{username}', 'UserController@deleteUser')->name('deleteUser');

            