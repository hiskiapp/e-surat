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

// Admin Routes
Route::group(['prefix' => config('app.admin_path'), 'as' => 'admin.', 'namespace' => 'Admin'], function()
{
	Route::get('/', function(){
		return redirect('home');
	});

	Route::get('login', 'AuthController@index')->name('login');
	Route::post('login', 'AuthController@login')->name('login');
	Route::post('logout', 'AuthController@logout')->name('logout');
	
	Route::group(['middleware' => 'auth:admin'], function()
	{
		Route::get('home', 'HomeController@index')->name('home');
		Route::resource('data', 'AdminController');
		Route::resource('users', 'UserController');
		Route::resource('letters', 'LetterController');

		Route::get('submissions/pending', 'SubmissionController@pending')->name('submission.pending');

		// Import
		Route::post('import/data', 'ImportController@admin')->name('import.data');

		// Account
		Route::get('account', 'AccountController@index')->name('account');
		Route::patch('account/update', 'AccountController@update')->name('account.update');
		Route::get('account/change-password', 'AccountController@update')->name('account.password');
		Route::patch('account/change-password', 'AccountController@update')->name('account.password.update');
		Route::get('account/logs', 'AccountController@logs')->name('account.logs');
	});
});

Route::get('/', function(){
	return redirect('home');
});

// User Routes
Route::get('login', 'AuthController@index')->name('login');
Route::post('login', 'AuthController@login')->name('login');
Route::post('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function()
{
	Route::get('home', 'HomeController@index')->name('home');
	Route::post('store/{letter}', 'SubmissionController@store')->name('store');

	// Account
	Route::get('account', 'AccountController@index')->name('account');
	Route::get('account/change-password', 'AccountController@changePassword')->name('account.password');
	Route::patch('account/change-password', 'AccountController@patchChangePassword')->name('account.password.update');
});