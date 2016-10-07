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
});

/* Patient module */
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'patient'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Patient\IndexController@index']);
    Route::get('/index/change-password', 'Patient\IndexController@changePassword');
    Route::post('/index/saveNewPassword', 'Patient\IndexController@saveNewPassword');
    Route::get('/index/supplement-request', 'Patient\IndexController@createSupplementRequest');
});

/* Practitioner module */
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'practitioner'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Practitioner\IndexController@index']);
    Route::get('marketing', ['as' => 'marketing', 'uses' => 'Practitioner\IndexController@viewMarketing']);
    Route::get('management', ['as' => 'management', 'uses' => 'Practitioner\IndexController@viewManagement']);
    Route::get('/index/change-password', 'Practitioner\IndexController@changePassword');
    Route::post('/index/saveNewPassword', 'Practitioner\IndexController@saveNewPassword');
    Route::get('/index/new-patient', ['as' => 'new-patient', 'uses' => 'Practitioner\IndexController@createPatient']);
    Route::post('/index/savePatient', 'Practitioner\IndexController@savePatient');
    Route::get('/index/patient-list', ['as' => 'patient-list', 'uses' => 'Practitioner\IndexController@patientList']);
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