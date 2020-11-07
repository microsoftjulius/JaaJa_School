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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/get-dashboard','HomeController@getDashboardBlade');
    Route::get('/logout','HomeController@logout');
    Route::get('/', function () {  return redirect('/home');});
    Route::get('/create-role','RoleController@validateRole');
    Route::get('/get-role','RoleController@getRoles')->name('Roles');
    Route::get('/assign-permissions-to-role','RoleController@assignPermissionsToRole');
    Route::delete('/delete-role/{id}','RoleController@deleteRole');
    Route::get('/get-assign-roles-page','RoleController@getAssignRolesPage')->name("Assign Roles");
    Route::get('/assign-role-to-a-user','RoleController@AssignRoleToUser');

    Route::get('/get-schools','UserController@getSchools')->name('Schools');
    Route::get('/get-users','UserController@getUsers')->name('Users');
    Route::post('/create-user','UserController@validateUser');
    Route::patch('/edit-user/{id}','UserController@editUser');
    Route::get('/suspend-school/{id}','UserController@suspendSchool');
    Route::get('/activate-school/{school_id}','UserController@activateSchool');

    Route::post('/create-student','StudentController@validatesubmitStudent');
    Route::get('/students','StudentController@getStudents')->name('Students');
    Route::patch('/edit-student/{id}','StudentController@editStudent');
    Route::get('/suspend-student/{id}','StudentController@suspendStudent');
    Route::get('/activate-student/{id}','StudentController@activateStudent');

    Route::post('/create-parent','ParentController@validateCreateParent');
    Route::get('/get-parents','ParentController@getParents')->name('Parents');
    Route::patch('/edit-parent/{id}','ParentController@editParentInformation');
    Route::get('/suspend-parent/{id}','ParentController@suspendParent');
    Route::get('/edit-parents-form/{id}','ParentController@editParentForm')->name('Parents');
    Route::get('/activate-parent/{id}','ParentController@activateParent');

    Route::get('/create-class','LevelController@validateCraeteClass');
    Route::get('/display-classes','LevelController@getClasses')->name('Classes');
    Route::get('/edit-class-form/{id}','LevelController@editClassForm')->name('Classes');
    Route::get('/edit-class/{id}','LevelController@editClass');
    Route::get('/delete-class/{id}','LevelController@deleteClass');
    Route::get('/get-class-homeworks/{class_id}','LevelController@getClassHomeworks');

    Route::get('/create-subject','SubjectController@validateCreateSubject');
    Route::get('/display-subjects','SubjectController@getSubjects')->name('Subjects');
    Route::get('/edit-subject/{id}','SubjectController@editSUbject');
    Route::get('/edit-subject-form/{id}','SubjectController@editSubjectForm')->name('Subjects');;
    Route::get('/delete-subject/{id}','SubjectController@deleteSubject');

    Route::post('/create-teacher','TeachersController@validateSubmitTeacher');
    Route::get('/display-teachers','TeachersController@getTeachers')->name('Teachers');
    Route::patch('/edit-teacher/{id}','TeachersController@editTeacher');
    Route::get('/suspend-teacher/{id}','TeachersController@suspendTeacher');
    Route::get('/activate-teacher/{teacher_id}','TeachersController@activateTeacher');

    Route::post('/create-home-work','HomeWorkController@validateCreateHomeWork');
    Route::get('/display-home-work','HomeWorkController@getHomeWork')->name('Home Work');
    Route::get('/edit-home-work/{id}','HomeWorkController@editHomeWork');
    Route::get('/delete-home-work/{id}','HomeWorkController@deleteHomeWork');
    Route::get('/edit-home-work-form/{id}','HomeWorkController@editHomeWorkForm')->name('Home Work');
    Route::get('/get-homeworks-reports','HomeWorkController@getHomeWorkReportsPage')->name('Home Work Reports');

    Route::post('/create-notes','NotesController@validateCreateNotes');
    Route::get('/display-notes','NotesController@getNotes')->name('Notes');
    Route::get('/edit-notes/{id}','NotesController@editNotes');
    Route::get('/edit-notes-form/{notes_id}','NotesController@editNotesForm')->name('Notes');
    Route::get('/delete-notes/{id}','NotesController@deletenotes');
    Route::get('/get-class-notes/{class_id}','NotesController@getClassNotes');
    Route::get('/get-class-notes-reports','NotesController@getNotesReports')->name('Notes Reports');

    Route::get('/home', 'HomeController@getDashboardBlade')->name('home');
    Route::get('/change-password','HomeController@getChangePasswordForm')->name('Change Password');
    Route::get('/update-password','HomeController@validateUserPassword');

    Route::post('/create-questions','QuestionsController@validateQuestions');
    Route::get('/edit-questions/{question_id}','QuestionsController@editQuestions');
    Route::get('/get-all-questions','QuestionsController@getAllQuestions')->name("Questions");
    Route::get('/delete-question/{question_id}','QuestionsController@deleteQuestion');
    Route::get('/get-school-questions','QuestionsController@getSchoolQuestions');
    Route::get('/edit-question-form/{question_id}','QuestionsController@editQuestionsForm')->name("Questions");
    Route::get('/get-class-questions/{class_id}','QuestionsController@getClassQuestions');
    Route::get('/get-questions-reports','QuestionsController@getUploadedQuestionsPerMonthReports')->name("Questions Reports");

    Route::post('/create-answers/{question_id}','AnswersController@validateAnswers');
    Route::get('/get-answers-to-question/{question_id}','AnswersController@getAnswersToQuestion')->name("Questions");
    Route::patch('/update-answers-to-question/{question_id}','AnswersController@updateAnswersToAQuestion');
    Route::delete('/delete-answers-to-question/{question_id}','AnswersController@deleteAnswer')->name("Questions");
    Route::get('/add-answers-form/{question_id}','AnswersController@addAnswersForm')->name("Questions");
    Route::get('/get-answers-reports','AnswersController@getAnswersReportsPage')->name('Answers Reports');

    Route::patch('/create-new-tutorial-for-answer/{answer_id}','TutorialsController@validateTutorial');
    Route::patch('/update-video-tutorial/{answer_id}','TutorialsController@updateVideoTutorial');

    Route::post('/add-new-past-paper','PastPapersController@validatePastPaper');
    Route::get('/get-past-papers','PastPapersController@getPastPapers')->name('Past Papers');
    Route::get('/edit-past_paper-form/{id}','PastPapersController@editPastPapersForm')->name('Past Papers');
    Route::get('/update-past-paper/{id}','PastPapersController@updatePastPaper');
    Route::get('/delete-past-paper/{id}','PastPapersController@deletePastPaper');
    Route::get('/get-class-past-papers/{class_id}','PastPapersController@getClassPastPapers');

    Route::post('/answers-for-homework/{home_work_id}','HomeWorkAnswersController@validateHomeWorkAnswers');
    Route::get('/edit-homework-answers-page/{home_work_id}','HomeWorkAnswersController@getHomeWorkEditPage')->name('Home Work');
    Route::post('/change-submited-answers-for-homework/{home_work_id}','HomeWorkAnswersController@changeStudentsSubmission');
    Route::get('/get-my-home-work-submissions','HomeWorkAnswersController@getStudentsHomeWorkSubmissions')->name('Home Work');
    Route::get('/get-homework-submissions-for-subject/{home_work_id}','HomeWorkAnswersController@getAllSubmissionsForThisHomeWork')->name('Home Work');
    Route::get('/attach-homework-answers-page/{home_work_id}','HomeWorkAnswersController@getHomeWorkAttachmentPage')->name('Home Work');

    Route::get('/add-marks-to-student/{student_id}/for-home-work/{homework_id}','HomeWorkMarksController@addStudentMarksPage');
    Route::get('/update-student-marks-for-homework/{homework_id}/for-student-/{student_id}','HomeWorkMarksController@updateStudentMarks');
    Route::get('/get-all-students-with-their-marks/{home_work_id}','HomeWorkMarksController@getAllStudentsWithMarks');
    Route::delete('/delete-student-marks/{home_work_id}','HomeWorkMarksController@deleteHomeworkMarksForStudent');

    Route::get('/get-settings-page','SettingsController@getSettingsPage')->name("Settings");
});
Auth::routes();