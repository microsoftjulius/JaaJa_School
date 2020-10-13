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

// Route::get('/', function () {  return view('welcome');});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/create-questions','QuestionsController@validateQuestions');
Route::patch('/edit-questions/{question_id}','QuestionsController@editQuestions');
Route::get('/get-all-questions','QuestionsController@getAllQuestions');