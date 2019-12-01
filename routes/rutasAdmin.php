<?php

Route::get('sistema','SistemaController@index')->name('sistema.index');
Route::get('/configuracion', function () { return view('Configuracion.index'); });

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
    Route::get('filtro','MenuController@filtro')->name('menu.filtro');
    Route::get('mostrarEliminados','MenuController@mostrarEliminados')->name('menu.mostrarEliminados');
    Route::get('todos','MenuController@mostrarTodos')->name('menu.mostrarTodos');
    Route::post('restaurar','MenuController@restaurar')->name('menu.restaurar');
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
    Route::post('eliminar','PermissionController@destroy')->name('permission.destroy');
});

Route::group(['prefix' => 'permission-role', 'middleware' => 'auth'], function(){
    Route::get('/', 'PermissionRoleController@index')->name('permission-role.index');
    Route::get('listarPermissionRoles','PermissionRoleController@listarPermissionRoles')->name('menu-role.listar-menu-roles');
    Route::post('guardar','PermissionRoleController@store')->name('permission-role.store');
});

Route::group(['prefix' => 'menu', 'middleware' => 'auth'], function(){
    Route::get('/', 'MenuController@index')->name('menu.index');
    Route::get('lista','MenuController@lista')->name('menu.lista');
    Route::get('padres','MenuController@padres')->name('menu.padres');
    Route::post('guardar','MenuController@store')->name('menu.store');
    Route::get('mostrar', 'MenuController@show')->name('menu.show');
    Route::put('actualizar','MenuController@update')->name('menu.update');
    Route::get('filtro','MenuController@filtro')->name('menu.filtro');
    Route::post('eliminar','MenuController@destroy')->name('menu.destroy');
});

Route::group(['prefix' => 'menu-role', 'middleware' => 'auth'], function(){
    Route::get('listarMenuRoles','RoleController@listarMenuRoles')->name('menu-role.listar-menu-roles');
    Route::post('guardar','RoleController@storeMenus')->name('menu-role.storeMenus');
});

Route::group(['prefix' => 'especialidad', 'middleware' => 'auth'], function(){
    Route::get('/', 'EspecialidadController@index')->name('especialidad.index');
    Route::get('todos','EspecialidadController@todos')->name('especialidad.todos');
    Route::get('habilitados','EspecialidadController@habilitados')->name('especialidad.habilitados');
    Route::get('eliminados','EspecialidadController@eliminados')->name('especialidad.eliminados');
    Route::post('guardar','EspecialidadController@store')->name('especialidad.store');
    Route::get('mostrar', 'EspecialidadController@show')->name('especialidad.show');
    Route::put('actualizar','EspecialidadController@update')->name('especialidad.update');
    Route::get('filtro','EspecialidadController@filtro')->name('especialidad.filtro');
    Route::post('eliminar-temporal','EspecialidadController@destroyTemporal')->name('especialidad.destroy-temporal');
    Route::post('eliminar-permanente','EspecialidadController@destroyPermanente')->name('especialidad.destroy-permanente');
    Route::post('restaurar','EspecialidadController@restaurar')->name('especialidad.restaurar');
});

Route::group(['prefix' => 'tabla', 'middleware' => 'auth'], function(){
    Route::get('/', 'ConfiguracionesController@index')->name('tabla.index');
});

Route::group(['prefix' => 'themeuser', 'middleware' => 'auth'], function(){
    Route::post('/actualizar-navbar','ThemeUserController@actualizarNavbar');
    Route::post('/actualizar-sidebar','ThemeUserController@actualizarSidebar');
    Route::post('/actualizar-brandlogo','ThemeUserController@actualizarBrandlogo');
    Route::post('/resetear','ThemeUserController@resetear');
});
