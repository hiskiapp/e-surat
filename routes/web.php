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
Route::group(['prefix' => config('app.admin_path'), 'as' => 'admin.', 'namespace' => 'Admin'], function () {
	Route::get('/', function () {
		return redirect('admin/home');
	});
	Route::get('login', 'AuthController@index')->name('login');
	Route::post('login', 'AuthController@login')->name('login');
	Route::post('logout', 'AuthController@logout')->name('logout');

	Route::group(['middleware' => 'auth:admin'], function () {
		Route::get('home', 'HomeController@index')->name('home');
		Route::resource('data', 'AdminController');
		Route::resource('users', 'UserController');
		Route::resource('letters', 'LetterController');

		Route::get('submissions/pending', 'SubmissionController@pending')->name('submissions.pending');
		Route::get('submissions/approved', 'SubmissionController@approved')->name('submissions.approved');
		Route::get('submissions/rejected', 'SubmissionController@rejected')->name('submissions.rejected');
		Route::get('submissions/show/{id}', 'SubmissionController@show')->name('submissions.show');
		Route::patch('submissions/status/{id}/{status}', 'SubmissionController@status')->name('submissions.status');
		Route::post('submissions/print/{id}', 'SubmissionController@print')->name('submissions.print');

		// Import
		Route::post('import/data', 'ImportController@admin')->name('import.data');
		Route::post('import/users', 'ImportController@user')->name('import.users');

		// Account
		Route::get('account', 'AccountController@index')->name('account');
		Route::patch('account', 'AccountController@update')->name('account');
		Route::get('account/password', 'AccountController@password')->name('account.password');
		Route::patch('account/password', 'AccountController@patchPassword')->name('account.password');
		Route::get('account/logs', 'AccountController@logs')->name('account.logs');

		// Setting
		Route::get('settings', 'SettingController@index')->name('settings');
		Route::patch('settings', 'SettingController@update')->name('settings');
	});
});

// User Routes
Route::get('/', function () {
	return redirect('home');
});
Route::get('login', 'AuthController@index')->name('login');
Route::post('login', 'AuthController@login')->name('login');
Route::post('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
	Route::get('home', 'HomeController@index')->name('home');
	Route::post('store/{letter}', 'SubmissionController@store')->name('store');

	// Account
	Route::get('account', 'AccountController@index')->name('account');
	Route::get('account/password', 'AccountController@password')->name('account.password');
	Route::patch('account/password', 'AccountController@patchPassword')->name('account.password');
	Route::get('account/logs', 'AccountController@logs')->name('account.logs');
});
