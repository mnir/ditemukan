<?php

Route::get('/', array('uses' => 'HomeController@index'));
Route::controller('users', 'UsersController');