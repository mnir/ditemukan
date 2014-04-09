<?php

class UsersController extends BaseController {

	public function __construct()
	{
		//parent::__construct();
	}

	public function getCreate()
	{
		return View::make('users.create');
	}

	public function postCreate()
	{
		$validator = Validator::make(Input::all(), array(
				'firstname' => 'required',
				'lastname'  => 'required',
				'email'     => 'required|email',
				'password'  => 'required'
			));

		if($validator->fails())
		{
			return Redirect::to('users/create')->withErrors($validator)->withInput();
		} else {
			$user = new User;
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::to('users/login')->with('message', 'Akun anda telah dibuat, silahkan melakukan login.');
		}
	}

	public function getLogin()
	{
		if(Auth::check())
		{
			return Redirect::to('/');
		}
		return View::make('users.login');
	}

	public function postLogin()
	{
		$validator = Validator::make(Input::all(), array(
				'email' => 'required|email',
				'password' => 'required'
			));

		if($validator->fails())
		{
			return Redirect::to('users/login')->withErrors($validator)->withInput()->with('message', 'email/password yang anda masukkan salah.');
		}

		$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			));
		if($auth) { return Redirect::to('/'); }
	}

}