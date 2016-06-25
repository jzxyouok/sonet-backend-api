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
Route::get('message.index','MessageController@index');
Route::post('message.store', 'MessageController@store');
Route::get('message.show.{$id}', 'MessageController@show');
Route::delete('message.destroy.{$id}','MessageController@destroy');

Route::get('conversation.index','ConversationController@index');
Route::post('conversation.store', 'ConversationController@store');
Route::get('conversation.show.{$id}', 'ConversationController@show');
Route::delete('conversation.destroy.{$id}','ConversationController@destroy');