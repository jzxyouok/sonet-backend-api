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

/*

Route::get('message.index','MessageController@index');
Route::post('message.store', 'MessageController@store');
Route::get('message.show/{id}', 'MessageController@show');
Route::delete('message.destroy/{id}','MessageController@destroy');

Route::get('conversation.index','ConversationController@index');
Route::post('conversation.store', ['middleware' => 'jwt.auth','uses' => 'ConversationController@store']);
Route::get('conversation.show/{id}', 'ConversationController@show');
Route::delete('conversation.destroy/{id}','ConversationController@destroy');
Route::get('conversation.messages','ConversationController@messages');
*/


Route::post('signin','AuthenticateController@signin');
Route::post('user.create','UserController@create');
Route::post('signup','AuthenticateController@signup');

Route::group(['middleware' => 'jwt.auth.group'], function () {
    
	Route::get('message.index','MessageController@index');
	Route::post('message.store', 'MessageController@store');
	Route::get('message.show', 'MessageController@show');
	Route::delete('message.destroy/{id}','MessageController@destroy');

	Route::get('conversation.index','ConversationController@index');
	Route::post('conversation.store', ['middleware' => 'jwt.auth','uses' => 'ConversationController@store']);
	Route::get('conversation.show', 'ConversationController@show');
	Route::delete('conversation.destroy/{id}','ConversationController@destroy');
	Route::get('conversation.messages','ConversationController@messages');

	Route::get('currentUser','UserController@currentUser');

});