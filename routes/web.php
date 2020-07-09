<?php

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>'auth'],function(){

Route::get('/dashboard','QuestionController@index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Answer Controller
Route::resource('/answer', 'AnswerController');
