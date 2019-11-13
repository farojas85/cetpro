<?php

Route::get('sistema','SistemaController@index')->name('sistema.index');

Route::group(['prefix' => 'role', 'middleware' => 'auth'], function(){
    Route::get('/', 'RoleController@index')->name('role.index');
    Route::get('lista','RoleController@listaRoles')->name('role.lista');
    Route::post('guardar','RoleController@store')->name('role.store');
    Route::get('mostrar','RoleController@show')->name('role.show');
    Route::put('actualizar','RoleController@update')->name('role.update');
    Route::post('eliminar','RoleController@destroy')->name('role.destroy');
    Route::get('buscar','RoleController@buscar')->name('role.buscar');
    Route::get('filtro','RoleController@filtro')->name('role.filtro');
});

Route::group(['prefix' => 'usuario', 'middleware' => 'auth'], function(){
    Route::get('/', 'UserController@index')->name('usuario.index');
    Route::get('lista','UserController@listaUsuario')->name('usuario.lista');
    Route::post('guardar','UserController@store')->name('usuario.store');
    Route::get('mostrar', 'UserController@show')->name('usuario.show');
    Route::put('actualizar','UserController@update')->name('usuario.update');
    Route::post('eliminar','UserController@destroy')->name('role.destroy');
});

Route::group(['prefix' => 'menu', 'middleware' => 'auth'], function(){
    Route::get('/', 'MenuController@index')->name('menu.index');
    Route::get('lista','MenuController@listaMenu')->name('menu.lista');
    Route::get('padres','MenuController@listaPadres')->name('menu.padres');
    Route::post('guardar','MenuController@store')->name('menu.store');
    Route::get('mostrar', 'MenuController@show')->name('menu.show');
    Route::put('actualizar','MenuController@update')->name('menu.update');
    Route::post('eliminar','MenuController@destroy')->name('menu.destroy');
});

Route::group(['prefix' => 'menu-role', 'middleware' => 'auth'], function(){
    Route::get('/', 'MenuRoleController@index')->name('menu-role.index');
    Route::get('listar', 'MenuRoleController@listarMenus')->name('menu-role.listar-menus');
    Route::get('listarMenuRoles','MenuRoleController@ListarMenuRoles')->name('menu-role.listar-menu-roles');
    Route::post('guardar','MenuRoleController@guardar')->name('menu-role.guardar');
});

Route::group(['prefix' => 'permission', 'middleware' => 'auth'], function(){
    Route::get('/', 'PermissionController@index')->name('permission.index');
    Route::get('lista','PermissionController@lista')->name('permission.lista');
    Route::post('guardar','PermissionController@store')->name('permission.store');
    Route::get('mostrar', 'PermissionController@show')->name('permission.show');
    Route::put('actualizar','PermissionController@update')->name('permission.update');
    Route::get('filtro','PermissionController@filtro')->name('permission.filtro');
});

Route::group(['prefix' => 'permission-role', 'middleware' => 'auth'], function(){
    Route::get('/', 'PermissionRoleController@index')->name('permission-role.index');
    Route::get('listarPermissionRoles','PermissionRoleController@listarPermissionRoles')->name('menu-role.listar-menu-roles');
    Route::post('guardar','PermissionRoleController@store')->name('permission-role.store');
});

Route::group(['prefix' => 'tabla', 'middleware' => 'auth'], function(){
    Route::get('/', 'ConfiguracionesController@index')->name('tabla.index');
});

Route::group(['prefix' => 'habilidad-social', 'middleware' => 'auth'], function(){
    Route::get('/', 'HabilidadSocialController@index')->name('habilidadsocial.index');
    Route::get('lista', 'HabilidadSocialController@lista')->name('habilidadsocial.lista');
    Route::post('guardar','HabilidadSocialController@store')->name('habilidadsocial.store');
    Route::get('mostrar', 'HabilidadSocialController@show')->name('habilidadsocial.show');
    Route::put('actualizar','HabilidadSocialController@update')->name('habilidadsocial.update');
    Route::post('eliminar','HabilidadSocialController@destroy')->name('habilidadsocial.destroy');
    Route::get('mostrarEliminados', 'HabilidadSocialController@showdeletes')->name('habilidadsocial.showdeletes');
    Route::post('restaurar','HabilidadSocialController@restoredelete')->name('habilidadsocial.restoredelete');
    Route::get('filtro','HabilidadSocialController@filtro')->name('habilidadsocial.filtro');
});

Route::group(['prefix' => 'estilo-aprendizaje', 'middleware' => 'auth'], function(){
    Route::get('/', 'EstiloAprendizajeController@index')->name('estiloaprendizaje.index');
    Route::get('lista', 'EstiloAprendizajeController@lista')->name('estiloaprendizaje.lista');
    Route::post('guardar','EstiloAprendizajeController@store')->name('estiloaprendizaje.store');
    Route::get('mostrar', 'EstiloAprendizajeController@show')->name('estiloaprendizaje.show');
    Route::put('actualizar','EstiloAprendizajeController@update')->name('estiloaprendizaje.update');
    Route::post('eliminar','EstiloAprendizajeController@destroy')->name('estiloaprendizaje.destroy');
    Route::get('mostrarEliminados', 'EstiloAprendizajeController@showdeletes')->name('estiloaprendizaje.showdeletes');
    Route::post('restaurar','EstiloAprendizajeController@restoredelete')->name('estiloaprendizaje.restoredelete');
});

Route::group(['prefix' => 'area', 'middleware' => 'auth'], function(){
    Route::get('/', 'AreaController@index')->name('area.index');
    Route::get('lista', 'AreaController@lista')->name('area.lista');
    Route::post('guardar','AreaController@store')->name('area.store');
    Route::get('mostrar', 'AreaController@show')->name('area.show');
    Route::put('actualizar','AreaController@update')->name('area.update');
    Route::post('eliminar','AreaController@destroy')->name('area.destroy');
    Route::get('mostrarEliminados', 'AreaController@showdeletes')->name('area.showdeletes');
    Route::post('restaurar','AreaController@restoredelete')->name('area.restoredelete');
    Route::get('filtro','AreaController@filtro')->name('area.filtro');
});

Route::group(['prefix' => 'personalidad', 'middleware' => 'auth'], function(){
    Route::get('/', 'PersonalidadController@index')->name('personalidad.index');
    Route::get('lista', 'PersonalidadController@lista')->name('personalidad.lista');
    Route::post('guardar','PersonalidadController@store')->name('personalidad.store');
    Route::get('mostrar', 'PersonalidadController@show')->name('personalidad.show');
    Route::put('actualizar','PersonalidadController@update')->name('personalidad.update');
    Route::post('eliminar','PersonalidadController@destroy')->name('personalidad.destroy');
    Route::get('mostrarEliminados', 'PersonalidadController@showdeletes')->name('personalidad.showdeletes');
    Route::post('restaurar','PersonalidadController@restoredelete')->name('personalidad.restoredelete');
    Route::get('filtro','PersonalidadController@filtro')->name('personalidad.filtro');
});

Route::group(['prefix' => 'ocupacion', 'middleware' => 'auth'], function(){
    Route::get('/', 'OcupacionController@index')->name('ocupacion.index');
    Route::get('lista', 'OcupacionController@lista')->name('ocupacion.lista');
    Route::post('guardar','OcupacionController@store')->name('ocupacion.store');
    Route::get('mostrar', 'OcupacionController@show')->name('ocupacion.show');
    Route::put('actualizar','OcupacionController@update')->name('ocupacion.update');
    Route::post('eliminar','OcupacionController@destroy')->name('ocupacion.destroy');
    Route::get('mostrarEliminados', 'OcupacionController@showdeletes')->name('ocupacion.showdeletes');
    Route::get('mostrarActivos','OcupacionController@showactives')->name('ocupacion.showactives');
    Route::post('restaurar','OcupacionController@restoredelete')->name('ocupacion.restoredelete');
    Route::get('filtro','OcupacionController@filtro')->name('ocupacion.filtro');
});

Route::group(['prefix' => 'test-burga', 'middleware' => 'auth'], function(){
    Route::get('/', 'BurgaController@index')->name('burga.index');
    Route::get('afirmacion-habilidad','BurgaController@afirmacion_habilidad')->name('burga.afirmacion-habilidad');
});

Route::group(['prefix' => 'burga-alternativa', 'middleware' => 'auth'], function(){
    Route::get('/', 'BurgaAlternativaController@index')->name('burga-alternativa.index');
    Route::get('lista', 'BurgaAlternativaController@lista')->name('burga-alternativa.lista');
    Route::post('guardar','BurgaAlternativaController@store')->name('burga-alternativa.store');
    Route::get('mostrar', 'BurgaAlternativaController@show')->name('burga-alternativa.show');
    Route::put('actualizar','BurgaAlternativaController@update')->name('burga-alternativa.update');
    Route::post('eliminar','BurgaAlternativaController@destroy')->name('burga-alternativa.destroy');
    Route::get('mostrarEliminados', 'BurgaAlternativaController@showdeletes')->name('burga-alternativa.showdeletes');
    Route::get('mostrarActivos','BurgaAlternativaController@showactives')->name('burga-alternativa.showactives');
    Route::post('restaurar','BurgaAlternativaController@restoredelete')->name('burga-alternativa.restoredelete');
    Route::get('filtro','BurgaAlternativaController@filtro')->name('burga-alternativa.filtro');
});

Route::group(['prefix' => 'burga-afirmacion', 'middleware' => 'auth'], function(){
    Route::get('/', 'BurgaAfirmacionController@index')->name('burga-afirmacion.index');
    Route::get('lista', 'BurgaAfirmacionController@lista')->name('burga-afirmacion.lista');
    Route::post('guardar','BurgaAfirmacionController@store')->name('burga-afirmacion.store');
    Route::get('mostrar', 'BurgaAfirmacionController@show')->name('burga-afirmacion.show');
    Route::put('actualizar','BurgaAfirmacionController@update')->name('burga-afirmacion.update');
    Route::post('eliminar','BurgaAfirmacionController@destroy')->name('burga-afirmacion.destroy');
    Route::get('mostrarEliminados', 'BurgaAfirmacionController@showdeletes')->name('burga-afirmacion.showdeletes');
    Route::get('mostrarActivos','BurgaAfirmacionController@showactives')->name('burga-afirmacion.showactives');
    Route::post('restaurar','BurgaAfirmacionController@restoredelete')->name('burga-afirmacion.restoredelete');
    Route::get('filtro','BurgaAfirmacionController@filtro')->name('burga-afirmacion.filtro');
    Route::get('listarAfirmacionesHabilidad','BurgaAfirmacionController@listarAfirmacionesHabilidad')
           ->name('burga-afirmacion.listarAfirmacionesHabilidad');
    Route::post('guardarAfirmaciones','BurgaAfirmacionController@guardar_afirmacion');
});

Route::group(['prefix' => 'colegio', 'middleware' => 'auth'], function(){
    Route::get('/', 'ColegioController@index')->name('colegio.index');
    Route::get('lista', 'ColegioController@lista')->name('colegio.lista');
    Route::post('subir', 'ColegioController@subir')->name('colegio.subir');
    Route::get('exportar', 'ColegioController@exportar')->name('colegio.exportar');
    Route::get('importarExportarVista', 'ColegioController@importarExportarVista');
    Route::post('importar', 'ColegioController@importar')->name('colegio.importar');
});

