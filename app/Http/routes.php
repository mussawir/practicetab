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

    Route::get('/nutrition', 'Admin\NutritionController@index');
    Route::get('/nutrition/new', 'Admin\NutritionController@create');
    Route::post('/nutrition/store', 'Admin\NutritionController@store');
    Route::get('/nutrition/edit/{id}', 'Admin\NutritionController@edit');
    Route::patch('/nutrition/update', 'Admin\NutritionController@update');
    Route::delete('/nutrition/destroy/{id}', 'Admin\NutritionController@destroy');

    Route::get('/exercises/', 'Admin\ExercisesController@index');
    Route::get('/exercises/index', 'Admin\ExercisesController@index');
    Route::get('/exercises/new', 'Admin\ExercisesController@create');
    Route::post('/exercises/store', 'Admin\ExercisesController@store');
    Route::get('/exercises/edit/{id}', 'Admin\ExercisesController@edit');
    Route::patch('/exercises/update', 'Admin\ExercisesController@update');
    Route::delete('/exercises/destroy/{id}', 'Admin\ExercisesController@destroy');

    Route::get('/manufacturer/', 'Admin\ManufacturerController@index');
    Route::get('/manufacturer/index', 'Admin\ManufacturerController@index');
    Route::get('/manufacturer/new', 'Admin\ManufacturerController@create');
    Route::post('/manufacturer/store', 'Admin\ManufacturerController@store');
    Route::get('/manufacturer/edit/{id}', 'Admin\ManufacturerController@edit');
    Route::patch('/manufacturer/update', 'Admin\ManufacturerController@update');
    Route::delete('/manufacturer/destroy/{id}', 'Admin\ManufacturerController@destroy');

    Route::get('/execategories/index', 'Admin\ExecategoriesController@index');
    Route::get('/execategories/new', 'Admin\ExecategoriesController@create');
    Route::post('/execategories/store', 'Admin\ExecategoriesController@store');
    Route::get('/execategories/edit/{id}', 'Admin\ExecategoriesController@edit');
    Route::patch('/execategories/update', 'Admin\ExecategoriesController@update');
    Route::delete('/execategories/destroy/{id}', 'Admin\ExecategoriesController@destroy');

    Route::get('/email-templates', 'Admin\EmailTemplateController@index');
    Route::get('/email-templates/new', 'Admin\EmailTemplateController@create');
    Route::post('/email-templates/store', 'Admin\EmailTemplateController@store');
    Route::get('/email-templates/edit/{id}', 'Admin\EmailTemplateController@edit');
    Route::patch('/email-templates/update', 'Admin\EmailTemplateController@update');
    Route::delete('/email-templates/destroy/{id}', 'Admin\EmailTemplateController@destroy');
});

/* Patient module */
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'patient'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Patient\IndexController@index']);
    Route::get('/index/change-password', 'Patient\IndexController@changePassword');
    Route::post('/index/saveNewPassword', 'Patient\IndexController@saveNewPassword');
    Route::get('/index/supplement-request', 'Patient\IndexController@createSupplementRequest');
    Route::post('/index/saveSupplementRequest', 'Patient\IndexController@saveSupplementRequest');
    Route::get('/index/suggestion-details', 'Patient\IndexController@suggestionDetails');
    Route::get('/index/supplement-suggestion-details/{id}', 'Patient\IndexController@supplementSuggestionDetails');
    Route::get('/index/nutrition-suggestion-details/{id}', 'Patient\IndexController@nutritionSuggestionDetails');
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
    Route::post('/schedule', ['as' => 'schedule', 'uses' => 'Practitioner\ManagementController@saveData']);
    Route::post('/Fetchschedule', ['as' => 'Fetchschedule', 'uses' => 'Practitioner\ManagementController@Fetchschedule']);
    Route::post('/FetchscheduleMax', ['as' => 'FetchscheduleMax', 'uses' => 'Practitioner\ManagementController@FetchscheduleMax']);
    Route::post('/FetchscheduleRow', ['as' => 'FetchscheduleRow', 'uses' => 'Practitioner\ManagementController@FetchscheduleRow']);
    Route::post('/updateScheduleData', ['as' => 'updateScheduleData', 'uses' => 'Practitioner\ManagementController@updateScheduleData']);
    Route::get('/contact', ['as' => 'contacts', 'uses' => 'Practitioner\ContactController@index']);
    Route::get('/contact/new', 'Practitioner\ContactController@create');
    Route::post('/contact/store', 'Practitioner\ContactController@store');
    Route::get('/contact/edit/{id}', 'Practitioner\ContactController@edit');
    Route::patch('/contact/update', 'Practitioner\ContactController@update');
    Route::delete('/contact/destroy/{id}', 'Practitioner\ContactController@destroy');

    Route::get('/exercises/', 'Practitioner\ExercisesController@index');
    Route::get('/exercises/index', 'Practitioner\ExercisesController@index');
    Route::get('/exercises/details/{id}', 'Practitioner\ExercisesController@show');

    Route::get('/patient/', 'Practitioner\PatientController@index');
    Route::get('/patient/index', 'Practitioner\PatientController@index');
    Route::get('/patient/new', 'Practitioner\PatientController@create');
    Route::post('/patient/store', 'Practitioner\PatientController@store');
    Route::get('/patient/edit/{id}', 'Practitioner\PatientController@edit');
    Route::patch('/patient/update', 'Practitioner\PatientController@update');
    Route::delete('/patient/destroy/{id}', 'Practitioner\PatientController@destroy');
    Route::get('/patient/files/{id}', 'Practitioner\PatientController@files');
    Route::post('/patient/upload-files', 'Practitioner\PatientController@uploadFiles');
    Route::delete('/patient/destroy-file/{pa_id}/{pf_id}', 'Practitioner\PatientController@destroyFile');

    Route::get('/exercise-prescription/', 'Practitioner\ExercisePrescriptionController@index');
    Route::get('/exercise-prescription/exercises', 'Practitioner\ExercisePrescriptionController@exercises');
    Route::get('/exercise-prescription/add-master/{id}', 'Practitioner\ExercisePrescriptionController@addMaster');
    Route::get('/exercise-prescription/add-exercise/{id}', 'Practitioner\ExercisePrescriptionController@addExercise');
    Route::post('/exercise-prescription/store-exercise', 'Practitioner\ExercisePrescriptionController@storeExercise');
    Route::delete('/exercise-prescription/delete-exercise/{id}', 'Practitioner\ExercisePrescriptionController@deleteExercise');
    Route::get('/exercise-prescription/print', 'Practitioner\ExercisePrescriptionController@printPrescribedExercises');
    Route::get('/exercise-prescription/prescribe', 'Practitioner\ExercisePrescriptionController@storeExePrescribedInfo');

    Route::get('/suggestion/supplement-suggestions-list', 'Practitioner\SuggestionController@showSupplementSuggestions');
    Route::get('/suggestion/supplement-suggestions-details/{id}', 'Practitioner\SuggestionController@supplementSuggestionDetails');
    Route::get('/suggestion/supplement-suggestions', 'Practitioner\SuggestionController@newSupplementSuggestions');
    Route::get('/suggestion/getSelectedPatient', 'Practitioner\SuggestionController@getSelectedPatient');
    Route::post('/suggestion/confirm-supplement-suggestions', 'Practitioner\SuggestionController@confirmSupplementSuggestions');
    Route::post('/suggestion/saveSupplementSuggestions', 'Practitioner\SuggestionController@saveSupplementSuggestions');
    Route::get('/suggestion/removeSelectedPatient', 'Practitioner\SuggestionController@removeSelectedPatient');

    Route::get('/suggestion/nutrition-suggestions-list', 'Practitioner\SuggestionController@showNutritionSuggestions');
    Route::get('/suggestion/nutrition-suggestions-details/{id}', 'Practitioner\SuggestionController@nutritionSuggestionDetails');
    Route::get('/suggestion/nutrition-suggestions', 'Practitioner\SuggestionController@newNutritionSuggestions');
    Route::post('/suggestion/confirm-nutrition-suggestions', 'Practitioner\SuggestionController@confirmNutritionSuggestions');
    Route::post('/suggestion/saveNutritionSuggestions', 'Practitioner\SuggestionController@saveNutritionSuggestions');

    Route::get('/profile/', 'Practitioner\ProfileController@index');
    Route::get('/profile/index', 'Practitioner\ProfileController@index');
    Route::patch('/profile/update', 'Practitioner\ProfileController@update');
    Route::get('/profile/clinic', 'Practitioner\ProfileController@clinic');
    Route::patch('/profile/clinic-update', 'Practitioner\ProfileController@clinicUpdate');
    Route::get('/profile/practice', 'Practitioner\ProfileController@practice');
    Route::patch('/profile/practice-update', 'Practitioner\ProfileController@practiceUpdate');
    Route::get('/profile/hours', 'Practitioner\ProfileController@hours');
    Route::patch('/profile/hours-update', 'Practitioner\ProfileController@hoursUpdate');


    Route::get('/blog', 'Practitioner\BlogController@index');
    Route::get('/blog/new', 'Practitioner\BlogController@create');
    Route::post('/blog/store', 'Practitioner\BlogController@store');
    Route::get('/blog/edit/{id}', 'Practitioner\BlogController@edit');
    Route::patch('/blog/update', 'Practitioner\BlogController@update');
    Route::delete('/blog/destroy/{id}', 'Practitioner\BlogController@destroy');

    Route::get('/email-templates', 'Practitioner\EmailTemplateController@index');

    Route::get('/emails', 'Practitioner\EmailsController@index');
    Route::get('/emails/new', 'Practitioner\EmailsController@create');
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

Route::get('logout', function(){
    Auth::logout();
    \Session::flush();
    //\Session::forget('pra_dir');
    return Redirect::to('/');
});

// do not show default registration form
Route::get('register', function(){
    return Redirect::to('/');
});