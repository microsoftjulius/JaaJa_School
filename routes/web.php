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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/create-role','RoleController@getRoles');
Route::get('/get-role','RoleController@getRoles')->name('Roles');
Route::get('/update-role/{id}','RoleController@deleteRole');

Route::get('/get-user','UserController@getUser')->name('All Users');
Route::post('/create-user','UserController@getUser');
Route::patch('/edit-user/{id}','UserController@editUser');
Route::delete('/delete-user/{id}','UserController@deleteUser');

Route::post('/create-student','StudentController@validatesubmitStudent');
Route::get('/student','StudentController@getStudent')->name('Student');
Route::patch('/edit-student/{id}','StudentController@editStudent');
Route::delete('/delete-student/{id}','StudentController@deleteStudent');

Route::post('/create-parent','ParentController@validateCreateParent');
Route::get('/parent-information','ParentController@getParent')->name('Parent');
Route::patch('/edit-parent/{id}','ParentController@editParentInformation');
Route::delete('/delete-parent/{id}','ParentController@deleteParent');

Route::post('/create-class','LevelController@validateCraeteClass');
Route::get('/display-class','LevelController@getClass')->name('Classes');
Route::patch('/edit-class/{id}','LevelController@editClass');
Route::delete('/delete-class/{id}','LevelController@deleteClass');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
