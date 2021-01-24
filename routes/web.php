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

Route::get('/', 'WelcomeController@welcome')->name('welcome');
Route::post('/', 'ContactFormController@store')->name('contact');

Route::view('/about', 'pages.about')->name('about');
Route::view('/projects', 'pages.projects')->name('projects');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/app', 'WelcomeController@login')->name('app');
Route::get('/users', 'UserController@index')->name('users');
Route::get('search/users', 'UserController@search')->name('users.search');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/personasfisicas', 'UserController@show')->name('personasfisicas');
Route::get('/edit/user/{user}', 'UserController@edit')->name('edit');

Route::get('/updocument', 'DocumentsController@updocument')->name('updocument');
Route::get('/documents/{document}/download', 'DocumentsController@download')->name('documents.download');
Route::get('/documents/{user}/mydocs', 'DocumentsController@showMyDocs')->name('documents.mydocs');

Route::resource('/users', 'UserController');
Route::resource('/documents', 'DocumentsController');
Route::resource('upload', 'PostsController');

//fullcalender
Route::get('/calendar','FullCalendarEventMasterController@index')->name('calendar');;
Route::post('/calendar/create','FullCalendarEventMasterController@create')->name('calendar.create');
Route::post('/calendar/update','FullCalendarEventMasterController@update')->name('calendar.update');;
Route::post('/calendar/delete','FullCalendarEventMasterController@destroy')->name('calendar.delete');