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
Route::get('assessments/{assessment}/enable', [
    'as' => 'assessments.enable', 'uses' => 'AssessmentsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::get('assessments/{assessment}/disable', [
    'as' => 'assessments.disable', 'uses' => 'AssessmentsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::resource('assessments', 'AssessmentsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('assessments', function($value, $route) {
    return App\AssAssessment::findBySlug($value)->first();
});

Route::get('assessments/{assessment}/categories/{category}/enable', [
    'as' => 'assessments.categories.enable', 'uses' => 'CategoriesController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::get('assessments/{assessment}/categories/{category}/disable', [
    'as' => 'assessments.categories.disable', 'uses' => 'CategoriesController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::resource('assessments.categories', 'CategoriesController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('categories', function($value, $route) {
    return App\AssCategory::findBySlug($value)->first();
});

Route::get('assessments/{assessment}/categories/{category}/items/{item}/enable', [
    'as' => 'assessments.categories.items.enable', 'uses' => 'ItemsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::get('assessments/{assessment}/categories/{category}/items/{item}/disable', [
    'as' => 'assessments.categories.items.disable', 'uses' => 'ItemsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::resource('assessments.categories.items', 'ItemsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('items', function($value, $route) {
    return App\AssItem::findBySlug($value)->first();
});

Route::get('assessments/{assessment}/categories/{category}/items/{item}/options/{option}/enable', [
    'as' => 'assessments.categories.items.options.enable', 'uses' => 'OptionsController@enable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::get('assessments/{assessment}/categories/{category}/items/{item}/options/{option}/disable', [
    'as' => 'assessments.categories.items.options.disable', 'uses' => 'OptionsController@disable'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::resource('assessments.categories.items.options', 'OptionsController')->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::bind('options', function($value, $route) {
    return App\AssOption::findBySlug($value)->first();
});

Route::get('assessments/{responder}/result', [
    'as' => 'assessments.result', 'uses' => 'AssessmentsController@result'
]);
Route::get('assessments/{assessment}/responders/{responder}/scores', [
    'as' => 'assessments.responders.scores', 'uses' => 'RespondersController@scores'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::get('assessments/{assessment}/responders/{responder}/print', [
    'as' => 'assessments.responders.print', 'uses' => 'RespondersController@print'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
Route::get('assessments/{assessment}/responders/{responder}/download', [
    'as' => 'assessments.responders.download', 'uses' => 'RespondersController@download'
])->middleware(['auth.user', 'auth.access:'.$link_id.',Manager']);
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
