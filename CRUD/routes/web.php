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

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);
//Загрузка главной страницы
Route::get('/', 'MainController@index');
//удаление записи по её айди
Route::delete('/employees/{id}', 'EmployeeController@destroy');
//Загрузка списка всех записей
Route::get('/employees', 'EmployeeController@index');
//Создание новой записи
Route::post('/employees', 'EmployeeController@create');
//Изменение существующей записи по её айди
Route::post('/employees/{id}', 'EmployeeController@update');

Auth::routes();
