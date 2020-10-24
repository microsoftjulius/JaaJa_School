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

Route::get('/get-dashboard','HomeController@getDashboardBlade');
Route::get('/logout','HomeController@logout');
Route::get('/', function () {  return view('welcome');});
Route::post('/create-role','RoleController@validateRole');
Route::get('/get-role','RoleController@getRoles')->name('Roles');
Route::patch('/edit-role/{id}','RoleController@editRole');
Route::delete('/delete-role/{id}','RoleController@deleteRole');

Route::get('/get-schools','UserController@getSchools')->name('Schools');
Route::get('/get-users','UserController@getUsers')->name('Users');
Route::post('/create-user','UserController@validateUser');
Route::patch('/edit-user/{id}','UserController@editUser');
Route::delete('/delete-user/{id}','UserController@deleteUser');

Route::post('/create-student','StudentController@validatesubmitStudent');
Route::get('/students','StudentController@getStudents')->name('Students');
Route::patch('/edit-student/{id}','StudentController@editStudent');
Route::delete('/delete-student/{id}','StudentController@deleteStudent');

Route::post('/create-parent','ParentController@validateCreateParent');
Route::get('/get-parents','ParentController@getParents')->name('Parents');
Route::patch('/edit-parent/{id}','ParentController@editParentInformation');
Route::delete('/delete-parent/{id}','ParentController@deleteParent');

Route::post('/create-class','LevelController@validateCraeteClass');
Route::get('/display-classes','LevelController@getClasses')->name('Classes');
Route::patch('/edit-class/{id}','LevelController@editClass');
Route::delete('/delete-class/{id}','LevelController@deleteClass');

Route::post('/create-subject','SubjectController@validateCreateSubject');
Route::get('/get-subject','SubjectController@getSubject')->name('Subjects');
Route::patch('/edit-subject/{id}','SubjectController@editSUbject');
Route::delete('/delete-subject/{id}','SubjectController@deleteSubject');

Route::post('/create-teacher','TeachersController@validateSubmitTeacher');
Route::get('/display-teachers','TeachersController@getTeachers')->name('Teachers');
Route::patch('/edit-teacher/{id}','TeachersController@editTeacher');
Route::delete('/delete-teacher/{id}','TeachersController@deleteTeacher');

Route::post('/create-home-work','HomeWorkController@validateCreateHomeWork');
Route::get('/get-home-work','HomeWorkController@getHomeWork')->name('Home Work');
Route::patch('/edit-home-work/{id}','HomeWorkController@editHomeWork');
Route::delete('/delete-home-work/{id}','HomeWorkController@deleteHomeWork');

Route::post('/create-notes','NotesController@validateCreateNotes');
Route::get('/get-notes','NotesController@getNotes')->name('Notes');
Route::patch('/edit-notes/{id}','NotesController@editNotes');
Route::delete('/delete-notes/{id}','NotesController@deletenotes');

Route::get('/home', 'HomeController@getDashboardBlade')->name('home');
Route::post('/create-questions','QuestionsController@validateQuestions');
Route::patch('/edit-questions/{question_id}','QuestionsController@editQuestions');
Route::get('/get-all-questions','QuestionsController@getAllQuestions')->name("Questions");
Route::delete('/delete-question/{question_id}','QuestionsController@deleteQuestion');
Route::get('/get-school-questions','QuestionsController@getSchoolQuestions');

Route::post('/create-answers/{question_id}','AnswersController@validateAnswers');
Route::get('/get-answers-to-question/{question_id}','AnswersController@getAnswersToQuestion');
Route::patch('/update-answers-to-question/{question_id}','AnswersController@updateAnswersToAQuestion');
Route::delete('/delete-answers-to-question/{question_id}','AnswersController@deleteAnswer');

Route::patch('/create-new-tutorial-for-answer/{answer_id}','TutorialsController@validateTutorial');
Route::patch('/update-video-tutorial/{answer_id}','TutorialsController@updateVideoTutorial');
Auth::routes();