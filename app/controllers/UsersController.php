<?php

class UsersController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf', ['on'=>'post']);
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
		}
		else
		{
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

		if($auth)
		{
			return Redirect::to('/');
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
	
	// Implementation of login/fb
	public function getFacebook() {
		
		$facebook = new Facebook(Config::get('facebook'));
		
		if (Request::segment(3) == 'callback') {
			
			$code = Input::get('code');
			
			if (strlen($code) == 0)
				return Redirect::to('/')
					->with('message', 'There was an error communicating with Facebook');						
			
			$uid = $facebook->getUser();
			
			if ($uid == 0)
				return Redirect::to('/')
					->with('message', 'There was an error');
			
			$me = $facebook->api('/me');
			
			$profile = Profile::whereUid($uid)->first();
			
			if (empty($profile)) {
				
				$user = new User;
				$user->firstname 	= $me['first_name'];
				$user->lastname 	= $me['last_name'];
				$user->email 		= $me['email'];
				$user->photo 		= 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';
			
				$user->save();
			
				$profile = new Profile();
				
				$profile->uid 		= $uid;
				$profile->username 	= $me['username'];
				$profile 			= $user->profiles()->save($profile);
			}
			
			$profile->access_token = $facebook->getAccessToken();
			$profile->save();
			
			$user = $profile->user;
			
			Auth::login($user);
			
			return Redirect::to('/')
				->with('message', 'Logged in with Facebook');
		} else {
		
			$params = array(
					'redirect_uri' => url('/users/facebook/callback'),
					'scope' => 'email',
			);
			
			return Redirect::to($facebook->getLoginUrl($params));
		}
	}

}