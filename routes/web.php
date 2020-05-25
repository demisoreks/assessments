<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$link_id = (int) config('var.link_id');

Route::get('/', [
    'as' => 'welcome', 'uses' => 'WelcomeController@index'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);

Route::post('assessments/{assessment}/submit', [
    'as' => 'assessments.submit', 'uses' => 'AssessmentsController@submit'
]);
Route::get('assessments/{assessment}/take', [
    'as' => 'assessments.take', 'uses' => 'AssessmentsController@take'
]);
Route::resource('assessments', 'AssessmentsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('assessments', function($value, $route) {
    return App\AssAssessment::findBySlug($value)->first();
});

Route::get('assessments/{responder}/result', [
    'as' => 'assessments.result', 'uses' => 'AssessmentsController@result'
]);
Route::resource('assessments.responders', 'RespondersController');
Route::bind('responders', function($value, $route) {
    return App\AssResponder::findBySlug($value)->first();
});

Route::get('option/{id}', function($id) {
    return App\AssOption::find($id);
});
Route::bind('options', function($value, $route) {
    return App\AssOption::findBySlug($value)->first();
});
