<?php 

/*
|--------------------------------------------------------------------------
| Admin Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Admin module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/
Route::group(['prefix' => 'admin', 'namespace' => 'App\Modules\Admin\Controllers'], function () {
	Route::get('/', ['as' => 'admin.index', 'uses' => 'IndexController@index']);
	
});