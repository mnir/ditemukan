<?php

Route::get('/', array('uses' => 'HomeController@index'));

Route::controller('users', 'UsersController');
Route::controller('items', 'ItemsController');
Route::controller('losts', 'LostsController');
Route::controller('founds', 'FoundsController');

Route::resource('user', 'UsersController');