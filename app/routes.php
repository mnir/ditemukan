<?php

Route::get('/', array(
	'as' =>	'HomeController',
	'uses' => 'HomeController@index'
));