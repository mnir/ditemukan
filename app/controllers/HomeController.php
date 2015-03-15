<?php

class HomeController extends BaseController {

	public function Index()
	{
		$user = Sentry::getUser();
		
		return View::make('main.index')->with('userId', $user->id);
	}

}