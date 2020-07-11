<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'QuestionController@index');
    Route::get('/question/create', 'QuestionController@create');
    Route::post('/question', 'QuestionController@store');
    Route::get('/dashboard', 'QuestionController@index');
    Route::get('/question/create', 'QuestionController@create');
    Route::put('/question/{question}','QuestionController@update');
    Route::get('/question/{question}', 'QuestionController@show');
    Route::delete('/question/{question}','QuestionController@destroy');
    Route::post('/question-comment', 'QuestionController@storecomment');
    Route::put('/question-comment/{answercomment}','QuestionController@updatecomment');
    Route::delete('/question-comment/{answercomment}','QuestionController@destroycomment');

});
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

use \App\Profile;
use \App\User;

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route User
Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/pertanyaan/buat', 'UserController@buat_pertanyaan');
    Route::post('/user/pertanyaan/buat', 'UserController@simpan_pertanyaan');
    //vote tanya
    Route::get('user/vote-tanya/{pertanyaan_id}/{user_id}/{vote}', 'UserController@vote_tanya');
    //vote jawab
    Route::get('user/vote-jawab/{jawaban_id}/{user_id}/{vote}', 'UserController@vote_jawab');
    //detail
    Route::get('pertanyaan/{pertanyaan_id}/detail', 'ForumController@index');
    //jawab pertanyaan
    Route::get('/jawab/{pertanyaan_id}', 'ForumController@jawab');
    Route::post('/jawab', 'ForumController@jawabcreate');
});

Route::get('/user/komentar/comment', 'UserController@buat_komen');
Route::get('/user/komentar/hal', 'UserController@buat_komen1');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
