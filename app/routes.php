<?php

Route::get('/', array('uses' => 'HomeController@index'));

$facebook = new Facebook(array(
    'appId' => Config::get('facebook.appId'),
    'secret' => Config::get('facebook.secret')
));

Route::controller('users', 'UsersController');
Route::controller('items', 'ItemsController');
Route::controller('losts', 'LostsController');
Route::controller('founds', 'FoundsController');