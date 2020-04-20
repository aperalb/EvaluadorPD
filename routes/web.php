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
    Route::get('/paciente/index/{id}', 'PacienteController@index');
    Route::get('/paciente/delete/{id}', 'PacienteController@delete');

    /*RESPONSABLES*/
    Route::get('/responsable/delete', 'ResponsableController@delete');
    Route::get('/responsable/editar', 'ResponsableController@editar');
    Route::get('/responsable/index/{id}', 'ResponsableController@index');
    Route::get('/responsable/{idResponsable}/{idPaciente}', 'ResponsableController@show2')->name('responsable.show2');

    Route::resource('/responsable', 'ResponsableController');


    /*TRATAMIENTOS*/
    Route::get('/tratamiento/index/{id}', 'TratamientoController@index');
    Route::resource('/tratamiento', 'TratamientoController');

    /*SINTOMAS*/
    Route::get('/sintoma/index/{id}', 'SintomaController@index');
    Route::resource('/sintoma', 'SintomaController');

    /*EVALUACIONES*/
    Route::post('/evaluacion/attach/{id}', 'EvaluacionController@attach')->name('evaluacion.attach');
    Route::get('/evaluacion/indexMisEvaluaciones', 'EvaluacionController@index2')->name('evaluacion.misEvaluaciones');
    Route::get('/evaluacion/index/{id}', 'EvaluacionController@index');
    Route::resource('/evaluacion', 'EvaluacionController');


    /*Formularios*/
    Route::get('/formulario/{idFormulario}/{idEvaluacion}', 'FormularioController@create')->name('formulario.create');
    Route::get('/formulario/show/{idFormulario}/{idEvaluacion}/{mensaje?}', 'FormularioController@show')->name('formulario.show');
    Route::post('/formulario/{idFormulario}/{idEvaluacion}', 'FormularioController@store')->name('formulario.store');
    Route::put('/formulario/{idFormulario}/{idEvaluacion}', 'FormularioController@update')->name('formulario.update');
});
