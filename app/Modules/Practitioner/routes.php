<?php 

/*
|--------------------------------------------------------------------------
| Practitioner Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the Practitioner module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/
Route::group(['prefix' => 'practitioner', 'namespace' => 'App\Modules\Practitioner\Controllers'], function () {
	Route::get('/', ['as' => 'practitioner.index', 'uses' => 'IndexController@index']);
	Route::get('marketing', ['as' => 'practitioner.marketing', 'uses' => 'IndexController@viewMarketing']);
	Route::get('management', ['as' => 'practitioner.management', 'uses' => 'IndexController@viewManagement']);
});