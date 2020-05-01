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

Route::get('/', function () {
    return view('welcome');
});

Route::post('assessments/{assessment}/submit', [
    'as' => 'assessments.submit', 'uses' => 'AssessmentsController@submit'
]);
Route::get('assessments/{assessment}/take', [
    'as' => 'assessments.take', 'uses' => 'AssessmentsController@take'
]);
Route::bind('assessments', function($value, $route) {
    return App\AssAssessment::findBySlug($value)->first();
});

Route::get('assessments/{responder}/result', [
    'as' => 'assessments.result', 'uses' => 'AssessmentsController@result'
]);
Route::bind('responders', function($value, $route) {
    return App\AssResponder::findBySlug($value)->first();
});

Route::get('option/{id}', function($id) {
    return App\AssOption::find($id);
});
Route::bind('options', function($value, $route) {
    return App\AssOption::findBySlug($value)->first();
});