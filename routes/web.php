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

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// view pages
Route::get('/questions', 'QuestionController@getAllQuestions')->name('question');
Route::get('/questions/single/{id}', 'QuestionController@getQuestionById')->name('question-single');


Route::get('/blogs', 'HomeController@getAllBlog')->name('all-blog');
Route::get('/blogs/single/{id}', 'HomeController@getAllBlogById')->name('blog-sinlge');

Route::get('/questions/add', function () {
    return view('question_add');
})->name('question_add');



Route::get('/service/add', 'HomeController@getService')->name('get-service');
Route::get('/service/get/result/{id}', 'HomeController@getResult')->name('get-service-result');
Route::get('/service/get/profile/', 'HomeController@getResultByPatient')->name('get-service-by-patient');









Route::get('/article/1st-trimeseter', 'HomeController@getArticle1st');
Route::get('/article/2nd-trimeseter', 'HomeController@getArticle2nd');
Route::get('/article/3rd-trimeseter', 'HomeController@getArticle3rd');











/*===================================
========< admin Routes >=======
===================================*/
Route::group(['middleware' => ['auth', 'admin']], function () {
    include_once 'admin/all.php';
});

// /*===================================
// ========< doctor Routes >=======
// ===================================*/

Route::group(['middleware' => ['auth', 'doctor']], function () {
    include_once 'doctor/all.php';
});

// /*===================================
// ========< patient Routes >=======
// ===================================*/

Route::group(['middleware' => ['auth', 'patient']], function () {
    include_once 'patient/all.php';
});



Auth::routes();

Route::post('/app/user/login', 'Auth\LoginController@loginWithEmailOrMobile')->name('user_login');

Route::get('/home', 'HomeController@index')->name('welcome2');
