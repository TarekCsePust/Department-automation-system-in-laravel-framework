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





Route::get('/','HomeController@login');
Route::get('/index','HomeController@index');
Route::get('/examDetails/{id}',
	'HomeController@getExamDetails');




Route::get('/entryExamDate','examScheduleController@entryExamDate');
Route::post('/addExamDate','examScheduleController@insertExamDate');
Route::post('/deleteExamDetail','examScheduleController@deleteExamDetail');






Route::get('/semesterDetails','semesterDetailsController@getSemesterDetails');
Route::post('/addSemesterDetail','semesterDetailsController@addSemesterDetail');
Route::post('/deleteSemesterDetail','semesterDetailsController@deleteSemesterDetail');








Route::post('/InsertToNewCourses','courseEntryController@InsertToNewCourse');


Route::get('/courseEdit/{id}','courseEntryController@findCourse');

Route::post('/courseChanges','courseEntryController@updateCourse');

Route::post('/courseRemove','courseEntryController@deleteCourse');


Route::get('/courseDetails','courseEntryController@getCourses');










Route::post('/addSession','sessionController@addSession');

Route::get('/session',
	'sessionController@getSessions');

Route::post('/sessionUpdate','sessionController@changeSession');

Route::post('/sessionDelete','sessionController@deleteSession');








Route::get('/semester',
	'semesterController@getSemesters');








Route::get('/courseAssign','courseAssignController@index');

Route::post('/courseAssignToSemester','courseAssignController@assignSemesterCourses');

Route::get('/courseAssignDetails','courseAssignController@getAllAssignSession');

Route::get('/assignSessionEdit/{id}','courseAssignController@findAssignSession');

Route::post('/assignChanges','courseAssignController@assignChange');

Route::post('/assignRemove','courseAssignController@assignDelete');

Route::get('/courseTeacherTracking/{id}','courseAssignController@getCourseTeacher');

Route::get('/assignTeacher/{id}','courseAssignController@assignTeacher');

Route::post('/courseTeacher','courseAssignController@insertCourseTeacher');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
