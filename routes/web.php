<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

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

// Route::get('/', function () {
//     return view('index');
// })->name('home');

Route::get('/registration', function () {
    return view('registration');
})->name('registration');
Route::get('/login', function () {
    Session::forget('email');
    return view('login');
})->name('login');
Route::get('/aboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');

Route::get('/orignal', function () {
    return view('orignal');
})->name('orignal');

// Home 
Route::get('/',['as' => 'home', 'uses' => 'homeController@index']);



Route::post('/registration', ['as' => 'registration.store','uses' => 'studentController@store']);
Route::post('/login-form', ['as' => 'form.login','uses' => 'studentController@login']);
Route::post('/admin-login', ['as' => 'admin.login','uses' => 'adminController@adminLogin']);
Route::get('/user/access', ['as' => 'admin.login-page','uses' => 'adminController@adminLoginPage']);

Route::middleware('loginAuth')->group(function () {  
    //Admin
    Route::get('admin-dashboard',['as' => 'admin.dashboard', 'uses' => 'adminController@dashboard']); 
    Route::get('admin-logout',['as' => 'admin.logout', 'uses' => 'adminController@logout']); 
    // Student
    Route::get('student-dashboard',['as' => 'student.dashboard', 'uses' => 'studentController@index']); 
    Route::get('logout',['as' => 'logout', 'uses' => 'studentController@logout']); 
    Route::get('images/{filename}', ['as' => 'image.show', 'uses' => 'Admin\TestController@showImg']);


    Route::prefix('student/')->group(function () {
        Route::get('test-instructions', ['as' => 'test.instruction', 'uses' => 'Admin\TestController@testInstruction']);
    });
    // Test
    Route::prefix('admin/')->group(function () {
        Route::get('test', ['as' => 'test', 'uses' => 'Admin\TestController@index']);
        Route::get('/addQna/{id}', ['as' => 'addQna', 'uses' => 'Admin\TestController@addQna']);
        Route::post('tests', ['as' => 'tests.store', 'uses' => 'Admin\TestController@store']);
        Route::get('/test/{test}/edit', ['as' => 'tests.edit', 'uses' => 'Admin\TestController@editTest']);
        Route::get('/edit-test/{id}', ['as' => 'editTest', 'uses' => 'Admin\TestController@editTest']);
        Route::delete('/delete-test/{id}', ['as' => 'tests.delete', 'uses' => 'Admin\TestController@deleteTest']);
        Route::post('/update-test/{test}', ['as' => 'tests.update', 'uses' => 'Admin\TestController@update']);
        Route::post('/add-questions-to-test', ['as' => 'add.QnaToTest', 'uses' => 'Admin\TestController@addQnaToTest']);

        // Question
        Route::get('question', ['as' => 'admin.question', 'uses' => 'QuestionController@index']);
        Route::post('question/store', ['as' => 'question.store', 'uses' => 'QuestionController@store']);
        Route::delete('/delete-question/{id}', ['as' => 'question.delete', 'uses' => 'QuestionController@deleteQuestion']);
        Route::get('/question/{id}/edit', ['as' => 'question.edit', 'uses' => 'QuestionController@editQuestion']);
        Route::post('/update-question/{id}', ['as' => 'question.update', 'uses' => 'QuestionController@updateQuestion']);

        // Student
        Route::get('/students',['as' => 'admin.students', 'uses' => 'adminController@student']);
        Route::delete('/delete-student/{id}', ['as' => 'student.delete', 'uses' => 'adminController@deleteStudent']);
        Route::get('/student/{id}/edit', ['as' => 'student.edit', 'uses' => 'adminController@editStudent']);
        Route::post('/update-student/{id}', ['as' => 'student.update', 'uses' => 'adminController@updateStudent']);


        //Route::post('students/store', ['as' => 'students.store', 'uses' => 'adminController@storestudent']);

        //


    });
    



});

