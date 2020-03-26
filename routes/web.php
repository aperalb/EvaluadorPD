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

Route::group(['middlewere'=>['web']], function(){
Route::get('/home', 'HomeController@index')->name('home');
/*MEDICO*/
Route::resource('/medico', 'MedicoController');
Route::get('/medico/index', function(){return view('medico.index');});
Route::get('/medico/create', function(){return view('medico.create');});
/*PACIENTE*/
Route::resource('/paciente', 'PacienteController');
Route::get('/paciente/index', function(){return view('paciente.index');});
Route::get('/paciente/show', function(){return view('paciente.show');});
Route::get('/paciente/edit', function(){return view('paciente.edit');});

/*RESPONSABLES*/
Route::resource('/responsable', 'ResponsableController');


});
