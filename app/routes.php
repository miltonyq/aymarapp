<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');


Route::get('/loginusuario', 'UserController@login_usuario');
Route::post('/loginusuariopost', 'UserController@login_usuario_post');
Route::get('/usuariologout', 'UserController@usuario_logout');

Route::group(array('prefix' => 'administrador'), function()
{
	Route::group(array('before' => 'administrador'), function()
	{
		Route::get('/', 'AdminController@admin_home');

		Route::get('/personas', 'AdminController@personas');
		Route::post('/personas/add', 'AdminController@personas_add');
		Route::get('/personas/edit/{id}', 'AdminController@personas_get_edit');
		Route::post('/personas/edit/{id}', 'AdminController@personas_post_edit');
		Route::get('/personas/delete/{id}', 'AdminController@personas_delete');
		
		Route::get('/nueva_palabra/get', 'AdminController@nueva_palabra_get');
		Route::post('/nueva_palabra/add', 'AdminController@nueva_palabra_add');
		Route::get('/palabra/edit/{id}', 'AdminController@palabra_get_edit');
		Route::post('/palabra/edit/{id}', 'AdminController@palabra_post_edit');
		Route::get('/palabra/delete/{id}', 'AdminController@palabra_delete');

        Route::get('/categorias', 'AdminController@categorias');
        Route::post('/categorias/add', 'AdminController@categorias_add');
        Route::get('/categorias/edit/{id}', 'AdminController@categorias_get_edit');
        Route::post('/categorias/edit/{id}', 'AdminController@categorias_post_edit');
        Route::get('/categorias/delete/{id}', 'AdminController@categorias_delete');

        Route::get('/categorias/oraciones/{id_cat}', 'AdminController@oraciones');
        Route::post('/categorias/oraciones/{id_cat}/add', 'AdminController@oraciones_add');
        Route::get('/categorias/oraciones/{id_cat}/edit/{id}', 'AdminController@oraciones_get_edit');
        Route::post('/categorias/oraciones/{id_cat}/edit/{id}', 'AdminController@oraciones_post_edit');
        Route::get('/categorias/oraciones/{id_cat}/delete/{id}', 'AdminController@oraciones_delete');

		
	});
});

Route::get('/loginpersona', 'PersonaController@login_persona');
Route::post('/loginpersonapost', 'PersonaController@login_persona_post');
Route::get('/personalogout', 'PersonaController@persona_logout');

Route::get('/registro/get', 'PersonaController@registro_get');
Route::post('/registro/post', 'PersonaController@registro_post');

Route::group(array('prefix' => 'panel'), function()
{
	Route::group(array('before' => 'panel'), function()
	{
		Route::get('/', 'PanelController@panel');


		Route::get('/busca_trad/get', 'PanelController@busca_trad_get');

		Route::get('/ajax_busca_palabra', 'PanelController@search_ajax');
		
		Route::get('/ajax_tipo_palabra', 'PanelController@tipo_ajax');

        Route::get('/tutorial/categoria/{cat_id}', 'PanelController@tutorial_categoria');
        Route::get('/tutorial/actividad/{cat_id}', 'PanelController@tutorial_actividad');
        Route::post('/tutorial/actividad/{cat_id}', 'PanelController@tutorial_actividad_post');
        Route::get('/tutorial/actividad_evaluar/{cat_id}', 'PanelController@tutorial_actividad_evaluar');

        Route::get('/tutorial/categoria_notas/get', 'PanelController@categoria_notas');
		
	});
});

