<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>['auth','admin'], 'prefix'=>'admin'], function(){
    Route::get('/users', 'UserController@index')->name('show.user.list');
    Route::patch('/user/{user}', 'UserController@update')->name('update');
});

Route::group(['middleware'=> ['auth','professor']], function(){
    Route::get('/lang', 'TaskController@selectLang')->name('select.lang');
    Route::post('/task', 'TaskController@store')->name('store.task');
    Route::get('/task/{locale}', 'TaskController@showTaskForm')->name('show.form');
    Route::delete('/task/{task}', 'TaskController@destroy')->name('delete.task');
    Route::get('/task/{taskId}/{operation}/{studentId}', 'TaskController@assigneeTask')->name('assignee.task');
    Route::get('/applications', 'TaskController@showTaskApplications')->name('show.applications');
});


Route::group(['middleware'=>'auth'], function(){
    Route::get('/task', 'TaskController@index')->name('show.tasks');
    Route::post('/task/application', 'TaskController@storeTaskApplication')->name('store.task.application');
});




