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
    Route::delete('/evaluacion/respuestas/{idFormulario}/{idEvaluacion}','EvaluacionController@destroyResolucion')->name('evaluacion.destroyResolucion');

    /*FORMULARIOS*/
    Route::post('/formulario/edit/{idFormulario}', 'FormularioController@edit')->name('formulario.edit');
    Route::get('/formulario/showList/{idFormulario}', 'FormularioController@showList')->name('formulario.showList');
    Route::get('/formulario/{idFormulario}/{idEvaluacion}', 'FormularioController@create')->name('formulario.create');
    Route::get('/formulario/show/{idFormulario}/{idEvaluacion}/{mensaje?}', 'FormularioController@show')->name('formulario.show');
    Route::post('/formulario/{idFormulario}/{idEvaluacion}', 'FormularioController@store')->name('formulario.store');
    Route::put('/formulario/{idFormulario}/{idEvaluacion}', 'FormularioController@update')->name('formulario.update');
    Route::get('/formulario/index', 'FormularioController@index')->name('formulario.index');
    Route::post('/formulario', 'FormularioController@altaFormulario')->name('formulario.altaFormulario');
    Route::delete('/formulario/{idFormulario}', 'FormularioController@destroy')->name('formulario.destroy');


    /*MEDICAMENTOS*/
    Route::get('/medicamento', 'MedicamentoController@index')->name('medicamento.index');
    Route::get('/medicamento/create', 'MedicamentoController@create')->name('medicamento.create');
    Route::post('/medicamento', 'MedicamentoController@store')->name('medicamento.store');
    Route::get('/medicamento/delete/{id}', 'MedicamentoController@delete');
    Route::get('/medicamento/edit/{id}', 'MedicamentoController@edit')->name('medicamento.edit');
    Route::put('/medicamento/{id}', 'MedicamentoController@update')->name('medicamento.update');
    Route::get('/medicamento/show/{idMedicamento}', 'MedicamentoController@show')->name('medicamento.show');

    /*PREGUNTA*/
    Route::put('/pregunta/{id}', 'PreguntaController@update')->name('pregunta.update');
    Route::delete('/pregunta/{id}', 'PreguntaController@destroy')->name('pregunta.destroy');

    /*CHARTS*/
    Route::get('/evaluacionChart/evolucionPacienteFormulario/{idPaciente}', 'EvaluacionController@evolucionPacienteFormulario')->name('evaluacion.evolucionPacienteFormulario');
    Route::get('/evaluacionGrafica/verGrafica/{id}', 'EvaluacionController@verGrafica')->name('evaluacion.verGrafica');
    Route::get('/evaluacionGrafica/verGrafica/{id}', 'EvaluacionController@verGrafica')->name('evaluacion.verGrafica');
    Route::get('/estadisticas', 'MedicoController@Estadisticas')->name('medico.Estadisticas');

});
