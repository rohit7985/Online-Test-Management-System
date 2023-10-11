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
Route::post('/contact', ['as' => 'contact.store', 'uses' => 'ContactUsController@store']);


Route::get('/auth/google', ['as' => 'google.login','uses' => 'GoogleLoginController@redirectToGoogle']);
Route::get('/auth/google/callback', ['as' => 'google.handleCallback','uses' => 'GoogleLoginController@handleGoogleCallback']);


Route::post('/registration', ['as' => 'registration.store','uses' => 'studentController@store']);
Route::post('/login-form', ['as' => 'form.login','uses' => 'studentController@login']);
Route::post('/admin-login', ['as' => 'admin.login','uses' => 'adminController@adminLogin']);
Route::get('/user/access', ['as' => 'admin.login-page','uses' => 'adminController@adminLoginPage']);

Route::middleware('loginAuth')->group(function () {  
    //Admin
    Route::get('admin-dashboard',['as' => 'admin.dashboard', 'uses' => 'adminController@dashboard']); 
    Route::get('admin-logout',['as' => 'admin.logout', 'uses' => 'adminController@logout']); 
    // Student

Route::middleware('auth')->group(function () {  
    Route::get('student-dashboard',['as' => 'student.dashboard', 'uses' => 'studentController@index']); 
});
    Route::get('logout',['as' => 'logout', 'uses' => 'studentController@logout']); 
    Route::get('images/{filename}', ['as' => 'image.show', 'uses' => 'Admin\TestController@showImg']);


    Route::prefix('student/')->group(function () {
        Route::get('test-instructions/{testID}', ['as' => 'test.instruction', 'uses' => 'Admin\TestController@testInstruction']);
        Route::get('profile', ['as' => 'student.profile', 'uses' => 'studentController@profile']);
        Route::post('change-password', ['as' => 'change.password', 'uses' => 'studentController@changePassword']);
    });
    // Test
    Route::prefix('admin/')->group(function () {
        Route::get('test', ['as' => 'test', 'uses' => 'Admin\TestController@index']);
        Route::get('test-result', ['as' => 'test-result', 'uses' => 'Admin\TestController@testResult']);
        Route::get('/addQna/{id}', ['as' => 'addQna', 'uses' => 'Admin\TestController@addQna']);
        Route::post('tests', ['as' => 'tests.store', 'uses' => 'Admin\TestController@store']);
        Route::get('/test/{test}/edit', ['as' => 'tests.edit', 'uses' => 'Admin\TestController@editTest']);
        Route::get('/edit-test/{id}', ['as' => 'editTest', 'uses' => 'Admin\TestController@editTest']);
        Route::delete('/delete-test/{id}', ['as' => 'tests.delete', 'uses' => 'Admin\TestController@deleteTest']);
        Route::post('/update-test/{test}', ['as' => 'tests.update', 'uses' => 'Admin\TestController@update']);
        Route::post('/add-questions-to-test', ['as' => 'add.QnaToTest', 'uses' => 'Admin\TestController@addQnaToTest']);
        Route::post('/attempt-test', ['as' => 'attempt.test', 'uses' => 'Admin\TestController@attemptTest']);
        Route::post('/submit-test', ['as' => 'submit.test', 'uses' => 'Admin\TestController@submitTest']);
        Route::delete('/delete-test-response/{id}', ['as' => 'question.delete', 'uses' => 'Admin\TestController@deleteTestResponse']);
        Route::get('/testResponse/{id}/edit', ['as' => 'testResponse.edit', 'uses' => 'Admin\TestController@editTestResponse']);



        // Question
        Route::get('question', ['as' => 'admin.question', 'uses' => 'QuestionController@index']);
        Route::post('question/store', ['as' => 'question.store', 'uses' => 'QuestionController@store']);
        Route::delete('/delete-question/{id}', ['as' => 'question.delete', 'uses' => 'QuestionController@deleteQuestion']);
        Route::get('/question/{id}/edit', ['as' => 'question.edit', 'uses' => 'QuestionController@editQuestion']);
        Route::post('/update-question/{id}', ['as' => 'question.update', 'uses' => 'QuestionController@updateQuestion']);
        Route::post('/add-question/{id}', ['as' => 'add.questions', 'uses' => 'QuestionController@addQuestion']);


        // Question Excel
        Route::post('/upload-exel', ['as' => 'import.excel', 'uses' => 'ExcelController@import']);
        // Student
        Route::get('/students',['as' => 'admin.students', 'uses' => 'adminController@student']);
        Route::delete('/delete-student/{id}', ['as' => 'student.delete', 'uses' => 'adminController@deleteStudent']);
        Route::get('/student/{id}/edit', ['as' => 'student.edit', 'uses' => 'adminController@editStudent']);
        Route::post('/update-student/{id}', ['as' => 'student.update', 'uses' => 'adminController@updateStudent']);


        //Route::post('students/store', ['as' => 'students.store', 'uses' => 'adminController@storestudent']);

        //


        Route::get('/contact',['as' => 'admin.contact', 'uses' => 'ContactUsController@index']);
        Route::delete('/delete-contact/{id}', ['as' => 'contact.delete', 'uses' => 'ContactUsController@deleteContact']);




    });
    



});

