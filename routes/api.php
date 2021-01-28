<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('products', 'Api\ProductController@index');


Route::prefix('company')->group(function(){
    Route::get('index', 'CompanyController@index');
    Route::post('create', 'CompanyController@create');
    Route::get('show/{id}', 'CompanyController@findCompany');
    Route::post('update', 'CompanyController@updateCompany');
    Route::post('delete', 'CompanyController@delete');
    Route::get('export', 'CompanyController@exportCompany');
    Route::post('import', 'CompanyController@importCompany');
});

Route::prefix('project')->group(function(){
    Route::get('index', 'ProjectController@index');
    Route::get('showcalendar', 'ProjectController@showCalendar');
    Route::post('create', 'ProjectController@create');
    Route::get('show/{id}', 'ProjectController@findProject');
    Route::post('update', 'ProjectController@updateProject');
    Route::delete('delete', 'ProjectController@delete');
    Route::get('taskboard/{id}', 'ProjectController@showTasks');
    Route::get('export/{id}/{comapnyname}', 'ProjectController@exportProjects');
    Route::post('import', 'ProjectController@importProjects');
});
Route::prefix('task')->group(function(){
    Route::get('index', 'TaskController@index');
    Route::post('create', 'TaskController@create')->name('task.create');
    Route::get('show/{id}', 'TaskController@findTask');
    Route::post('update', 'TaskController@updateTask');
    Route::post('delete', 'TaskController@deleteTask');
    Route::patch('updatestatus/{id}', 'TaskController@updateTaskStatus');
    Route::put('updateAll', 'TaskController@updateTaskOrder');

});

Route::get('pythontest', 'ProjectController@testpython');
