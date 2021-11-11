<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('auth.login');
//});

//Auth::routes();
Route::get('/', 'StudentController@index')->name('student.index');
Route::get('/students-list', 'StudentController@index')->name('student.index');
Route::get('/students', 'StudentController@create')->name('student.create');
Route::post('/students', 'StudentController@store')->name('student.store');
Route::get('/students/{student}', 'StudentController@edit')->name('student.edit');
Route::post('/students/{student}', 'StudentController@update')->name('student.update');
Route::delete('/students/{student}', 'StudentController@destroy')->name('student.destroy');
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::post('/contact', 'ContactController@contactSubmit')->name('contact.contactSubmit');
Route::post('/students-list', 'StudentController@exportIntoExcel')->name('student.exportIntoExcel');
Route::get('/export-csv', 'StudentController@exportIntoCsv')->name('student.exportIntoCsv');
Route::post('import', 'StudentController@import')->name('import');
Route::get('/import-form', 'StudentController@importForm');
Route::get('/search', 'StudentController@search');
