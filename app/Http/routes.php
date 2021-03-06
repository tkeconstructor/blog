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

Route::get('404',function(){
	return view('errors.404');
});

// Authentication
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@logout');

Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');


//Login Routes for Admin...
Route::get('admin/login','Admin\AuthController@getLogin');
Route::post('admin/login','Admin\AuthController@postLogin');
Route::get('admin/logout','Admin\AuthController@logout');

// Registration Routes admin ...
Route::get('admin/register', 'Admin\AuthController@getRegister');
Route::post('admin/register', 'Admin\AuthController@postRegister');
Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
	

	Route::get('/', 'Admin\AdminController@index');

	// route for categories
	Route::get('/categories','Admin\CategoriesController@index');
	Route::post('/categories','Admin\CategoriesController@create');
	Route::post('/categories/update','Admin\CategoriesController@update');

	// route for courses
	Route::get('/courses','Admin\CoursesController@index');
	Route::post('/courses','Admin\CoursesController@create');
	Route::post('/courses/update','Admin\CoursesController@update');
	Route::get('/courses/{id}','Admin\CoursesController@show');


	Route::post('/courses/{id}','Admin\CoursesController@assignLecture');

});


Route::get('/', function () {
    return redirect('/login');
});


Route::get('/home', 'HomeController@index');


//route lecturer
Route::group( [
	'prefix' => 'lecturer',
    'middleware' => ['auth', 'roles'],
    'roles' => 'lecturer'], function () {
    Route::get('/', 'Lecturer\LecturerController@index');

    Route::group( ['prefix' => 'question'], function () {
	    Route::get('/', 'Lecturer\QuestionController@index');
	    Route::get('/create', 'Lecturer\QuestionController@create');
	    Route::post('/create', 'Lecturer\QuestionController@store');
	    Route::get('/{id}', 'Lecturer\QuestionController@view');
	});

	Route::group( ['prefix' => 'quiz'], function () {
	    Route::get('/', 'Lecturer\QuizController@index');
	    Route::get('/create', 'Lecturer\QuizController@create');
	    Route::post('/create', 'Lecturer\QuizController@store');
	    Route::get('/{id}/activate', 'Lecturer\QuizController@active');
	    
	    // Question in quiz
	    Route::get('/{id}/question', 'Lecturer\QuizController@question');
	    Route::get('/{id}/question/add', 'Lecturer\QuizController@add_question');
	    Route::get('/{id}/question/add/{qsid}', 'Lecturer\QuizController@add_question_store');
	    Route::get('/{id}/question/create', 'Lecturer\QuizController@create_question');
	    Route::post('/{id}/question/create', 'Lecturer\QuizController@store_question');
	});

});