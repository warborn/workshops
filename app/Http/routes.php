<?php

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

Route::get('/', 'HomeController@index');

Route::get('/teachers', 'TeachersController@index');
Route::post('/teachers', 'TeachersController@store');
Route::delete('/teachers/{teacher}', 'TeachersController@destroy');

Route::get('/courses', 'CoursesController@index');
Route::post('/courses', 'CoursesController@store');
Route::delete('/courses/{course}', 'CoursesController@destroy');

Route::get('/classrooms', 'ClassroomsController@index');
Route::post('/classrooms', 'ClassroomsController@store');
Route::delete('/classrooms/{classroom}', 'ClassroomsController@destroy');

Route::get('/workshops', 'WorkshopsController@index');
Route::post('/workshops', 'WorkshopsController@store');
Route::delete('/workshops/{workshop}', 'WorkshopsController@destroy');