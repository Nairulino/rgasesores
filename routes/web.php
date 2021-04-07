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
Route::get('search/personasfisicas', 'UserController@searchPersonasFisicas')->name('personasfisicas.search');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/personasfisicas', 'UserController@show')->name('personasfisicas');
Route::get('/updocument', 'DocumentsController@updocument')->name('updocument');
Route::get('/documents/{document}/download', 'DocumentsController@download')->name('documents.download');
Route::get('/documents/{user}/mydocs', 'DocumentsController@showMyDocs')->name('documents.mydocs');

Route::resource('/users', 'UserController');
Route::resource('/documents', 'DocumentsController');
Route::resource('/upload', 'PostsController');



// fullcalender
Route::get('/calendar','FullCalendarEventMasterController@index')->name('calendar');
Route::post('/calendar/create','FullCalendarEventMasterController@create')->name('calendar.create');
Route::put('/calendar/update','FullCalendarEventMasterController@update')->name('calendar.update');
Route::delete('/calendar/delete','FullCalendarEventMasterController@destroy')->name('calendar.delete');
Route::put('/calendar/edit','FullCalendarEventMasterController@edit')->name('calendar.edit');

// Empresas
Route::view('/addEmpresa','auth.registrarEmpresa')->name('empresa');
Route::get('/empresas', 'EmpresaController@show')->name('empresas');
Route::post('/empresa/create','EmpresaController@create')->name('empresa.create');
Route::get('/search/empresa','EmpresaController@searchEmpresas')->name('empresas.search');

// Sociedades
Route::view('/addSociedad','auth.registrarSociedad')->name('sociedad');
Route::get('/sociedades', 'SociedadController@show')->name('sociedades');
Route::post('/sociedad/create','SociedadController@create')->name('sociedad.create');
Route::get('/search/sociedades','SociedadController@searchSociedades')->name('sociedades.search');

// Consultas
Route::resource('/consultas', 'ConsultaController');
Route::view('/create/consulta', 'consulta.create')->name('newConsulta');
Route::get('/consulta/answer/{id}', 'ConsultaController@answer')->name('consultas.answer');
Route::post('/consulta/response', 'ConsultaController@response')->name('consultas.response');