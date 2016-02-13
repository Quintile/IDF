<?php

Route::get('meals', array('as' => 'meals', 'uses' => 'Excessive\IDF\Controllers\MealController@index'));
Route::post('meals', array('uses' => 'Excessive\IDF\Controllers\MealController@createPost'));
Route::get('meals/{id}/manage', array('as' => 'meals.manage', 'uses' => 'Excessive\IDF\Controllers\MealController@manage'));
Route::post('meals/{id}/manage', array('uses' => 'Excessive\IDF\Controllers\MealController@managePost'));

Route::get('portions', array('as' => 'portions.add', 'uses' => 'Excessive\IDF\Controllers\PortionController@add'));
Route::post('portions', array('uses' => 'Excessive\IDF\Controllers\PortionController@addPost'));
Route::get('portions/{id}/edit', array('as' => 'portions.edit', 'uses' => 'Excessive\IDF\Controllers\PortionController@add'));
Route::post('portions/{id}/edit', array('uses' => 'Excessive\IDF\Controllers\PortionController@addPost'));

Route::get('portions/{id}/ingredients', array('as' => 'portions.ingredients', 'uses' => 'Excessive\IDF\Controllers\PortionController@ingredients'));
Route::post('portions/{id}/ingredients', array('uses' => 'Excessive\IDF\Controllers\PortionController@ingredientsPost'));
Route::post('portions/{id}/types', array('as' => 'portions.types.add', 'uses' => 'Excessive\IDF\Controllers\PortionController@addType'));

Route::get('plan', ['as' => 'meals.plan', 'uses' => 'Excessive\IDF\Controllers\MealController@plan']);
Route::get('plan/{date}', ['as' => 'meals.plan.date', 'uses' => 'Excessive\IDF\Controllers\MealController@plan']);

Route::post('plan', ['uses' => 'Excessive\IDF\Controllers\MealController@planPost']);