<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pricing', function () {
    return view('pricing');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/affiliate', function () {
    return view('affiliate');
});


//Route::get('registration/pricing', ['as' => 'pricing', 'uses' => 'RegistrationController@showPricingPage']);

Route::get('registration/account', ['as' => 'account', 'uses' => 'RegistrationController@showAccountPage']);
Route::post('registration/account', ['as' => 'account', 'uses' => 'RegistrationController@showAccountPage']);
Route::post('registration/savePractitioner', 'RegistrationController@savePractitioner');
Route::post('registration/newPractitioner', 'RegistrationController@newPractitioner');
Route::get('registration/account/payment', ['as' => 'payment', 'uses' => 'RegistrationController@showAccountPaymentPage']);
Route::post('registration/saveAccountPayment', 'RegistrationController@saveAccountPayment');

Route::auth();

Route::post('/contact', 'HomeController@saveContactInfo');

/* Admin module */
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'admin'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\IndexController@index']);
    Route::get('/index/change-password', 'Admin\IndexController@changePassword');
    Route::post('/index/saveNewPassword', 'Admin\IndexController@saveNewPassword');

    Route::get('/supplements/index', 'Admin\SupplementsController@index');
    Route::get('/supplements/new', 'Admin\SupplementsController@create');
    Route::post('/supplements/store', 'Admin\SupplementsController@store');
    Route::get('/supplements/edit/{id}', 'Admin\SupplementsController@edit');
    Route::patch('/supplements/update', 'Admin\SupplementsController@update');
    Route::delete('/supplements/destroy/{id}', 'Admin\SupplementsController@destroy');

    Route::get('/nutritions/index', 'Admin\NutritionsController@index');
    Route::get('/nutritions/new', 'Admin\NutritionsController@create');
    Route::post('/nutritions/store', 'Admin\NutritionsController@store');
    Route::get('/nutritions/edit/{id}', 'Admin\NutritionsController@edit');
    Route::patch('/nutritions/update', 'Admin\NutritionsController@update');
    Route::delete('/nutritions/destroy/{id}', 'Admin\NutritionsController@destroy');

    Route::get('/exercises/index', 'Admin\ExercisesController@index');
    Route::get('/exercises/new', 'Admin\ExercisesController@create');
    Route::post('/exercises/store', 'Admin\ExercisesController@store');
    Route::get('/exercises/edit/{id}', 'Admin\ExercisesController@edit');
    Route::patch('/exercises/update', 'Admin\ExercisesController@update');
    Route::delete('/exercises/destroy/{id}', 'Admin\ExercisesController@destroy');

    Route::get('/manufacturer/index', 'Admin\ManufacturerController@index');
    Route::get('/manufacturer/new', 'Admin\ManufacturerController@create');
    Route::post('/manufacturer/store', 'Admin\ManufacturerController@store');
    Route::get('/manufacturer/edit/{id}', 'Admin\ManufacturerController@edit');
    Route::patch('/manufacturer/update', 'Admin\ManufacturerController@update');
    Route::delete('/manufacturer/destroy/{id}', 'Admin\ManufacturerController@destroy');
});

/* Patient module */
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'patient'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Patient\IndexController@index']);
    Route::get('/index/change-password', 'Patient\IndexController@changePassword');
    Route::post('/index/saveNewPassword', 'Patient\IndexController@saveNewPassword');
    Route::get('/index/supplement-request', 'Patient\IndexController@createSupplementRequest');
    Route::post('/index/saveSupplementRequest', 'Patient\IndexController@saveSupplementRequest');
    Route::get('/index/suggestion-details', 'Patient\IndexController@suggestionDetails');
});

/* Practitioner module */
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'practitioner'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Practitioner\IndexController@index']);
    Route::get('/index/change-password', 'Practitioner\IndexController@changePassword');
    Route::post('/index/saveNewPassword', 'Practitioner\IndexController@saveNewPassword');
    Route::get('/index/new-patient', ['as' => 'new-patient', 'uses' => 'Practitioner\IndexController@createPatient']);
    Route::post('/index/savePatient', 'Practitioner\IndexController@savePatient');
    Route::get('/index/patient-list', ['as' => 'patient-list', 'uses' => 'Practitioner\IndexController@patientList']);
    Route::get('/index/suggestions', 'Practitioner\IndexController@newSuggestions');
    Route::post('/index/saveSuggestions', 'Practitioner\IndexController@saveSuggestions');

    Route::get('/marketing', ['as' => 'marketing', 'uses' => 'Practitioner\MarketingController@index']);

    Route::get('/management', ['as' => 'management', 'uses' => 'Practitioner\ManagementController@index']);

    Route::get('/contact-group', ['as' => 'contacts', 'uses' => 'Practitioner\ContactGroupController@index']);
    Route::get('/contact-group/new', 'Practitioner\ContactGroupController@create');
    Route::post('/contact-group/store', 'Practitioner\ContactGroupController@store');
    Route::get('/contact-group/edit/{id}', 'Practitioner\ContactGroupController@edit');
    Route::patch('/contact-group/update', 'Practitioner\ContactGroupController@update');
    Route::delete('/contact-group/destroy/{id}', 'Practitioner\ContactGroupController@destroy');

    Route::get('/contact', ['as' => 'contacts', 'uses' => 'Practitioner\ContactController@index']);
    Route::get('/contact/new', 'Practitioner\ContactController@create');
    Route::post('/contact/store', 'Practitioner\ContactController@store');
    Route::get('/contact/edit/{id}', 'Practitioner\ContactController@edit');
    Route::patch('/contact/update', 'Practitioner\ContactController@update');
    Route::delete('/contact/destroy/{id}', 'Practitioner\ContactController@destroy');

});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users','UserController');
});

Route::get('users/admin/login', ['as' => 'login', 'uses' => 'UserController@showAdminLogin']);
Route::get('users/patient/login', ['as' => 'login', 'uses' => 'UserController@showPatientLogin']);
Route::get('users/practitioner/login', ['as' => 'login', 'uses' => 'UserController@showPractitionerLogin']);

Route::post('login', function()
{
    $credentials = Input::only('email', 'password');
    if (!Auth::attempt($credentials))
    {
        return Redirect::back()->with('warning', 'Email or password is invalid');
    }

    if (Auth::user()->role==1 || Auth::user()->role==2) // super admin and admin
    {
        return Redirect::to('/admin');
    }

    if (Auth::user()->role==3) // practitioner
    {
        return Redirect::to('/practitioner');
    }

    if (Auth::user()->role==4) // patient
    {
        return Redirect::to('/patient');
    }

    return Redirect::Back();
});

Route::get('login', function(){
    return Redirect::to('users/patient/login');
});

// do not show default registration form
Route::get('register', function(){
    return Redirect::to('/');
});