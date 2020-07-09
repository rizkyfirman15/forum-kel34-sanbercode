<?php

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>'auth'],function(){

Route::get('/dashboard','QuestionController@index');
Route::get('/question/create','QuestionController@create');
Route::post('/question','QuestionController@store');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Answer Controller
Route::resource('/answer', 'AnswerController');
