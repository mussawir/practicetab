<?php 

/*
|--------------------------------------------------------------------------
| Patient Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Patient module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/
Route::group(['prefix' => 'patient', 'namespace' => 'App\Modules\Patient\Controllers'], function () {
	Route::get('/', ['as' => 'patient.index', 'uses' => 'IndexController@index']);
	
});