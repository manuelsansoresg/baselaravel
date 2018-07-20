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

use Zizaco\Entrust\Entrust;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin/home', 'HomeController@index')->name('home');

/*Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin/home', 'HomeController@index');
});*/

;
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|root|user']], function() {
    Route::get('/', 'AdminController@welcome');
    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
    //Route::get('/admin/home', 'HomeController@index');
});



Route::group(['prefix' => 'admin'], function (){
    Route::resource('user', 'UserController');
    Route::get('users/{id}/destroy',[
        'uses' => 'UserController@destroy',
        'as' => 'admin.users.destroy'
    ]);
});

