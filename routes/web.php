<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'QuestionController@index');
    Route::get('/question/create', 'QuestionController@create');
    Route::post('/question', 'QuestionController@store');
    Route::get('/dashboard', 'QuestionController@index');
    Route::get('/question/create', 'QuestionController@create');
    Route::post('/question', 'QuestionController@store');
    Route::get('/question/1', 'QuestionController@show');
    // Answer Controller
    Route::resource('/answer', 'AnswerController');
    Route::put('/answer/{id}/vote', 'AnswerController@vote');
    Route::get('/answer/{id}/create', 'AnswerController@create');
    Route::post('/answer/{id}/create', 'AnswerController@create');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
