<?php
Route::get('buscar-dni','AlumnoController@buscarDni')->name('alumno.buscar-dni');
Route::get('buscar-departamento','AlumnoController@getDepartamentos')->name('alumno.buscar-departamento');

Route::group(['prefix' => 'alumno', 'middleware' => 'auth'], function(){
});