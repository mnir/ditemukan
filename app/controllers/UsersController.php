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
			'username'	=> 'required',
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
			$user->username	= Input::get('username');
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			
			$profile = new Profile();
			
			
			$profile->type 		= 'general';
			$profile 			= $user->profiles()->save($profile);				
			$profile->save();
			
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
	
	public function getFacebook() 
	{		
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
				$user->username 	= $me['username'];
				$user->firstname 	= $me['first_name'];
				$user->lastname 	= $me['last_name'];
				$user->email 		= $me['email'];
				$user->photo 		= 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';
			
				$user->save();
			
				$profile = new Profile();
				
				$profile->uid 		= $uid;
				$profile->type 		= 'facebook';
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
	
	public function getTwitter() 
	{			
		switch (Request::segment(3)) {
			case 'callback':
				
				$twitter_con = new TwitterOAuth(
					Config::get('twitter.twitter_consumer_token'),
					Config::get('twitter.twitter_consumer_secret'),
					Session::get('twitter_oauth_token'),
					Session::get('twitter_oauth_token_secret')
				);
				
				if (Input::get('oauth_token') AND Session::get('twitter_oauth_token') !== Input::get('oauth_token')) {
					return Redirect::to('/users/twitter/logout');
				} else {					
					
					$oauth = $twitter_con->getAccessToken(Input::get('oauth_verifier'));										
															
					if ($twitter_con->http_code == 200) {
						
						Session::forget('twitter_oauth_token');
						Session::forget('twitter_oauth_token_secret');
						
						$twitter = new TwitterOAuth(
							Config::get('twitter.twitter_consumer_token'),
							Config::get('twitter.twitter_consumer_secret'),
							$oauth['oauth_token'],
							$oauth['oauth_token_secret']
						);
						
						$me = $twitter->get('users/show',array(
							'user_id'	=> $oauth['user_id']
						));
						
						$profile = Profile::whereUid($oauth['user_id'])->first();
						
						if (empty($profile)) {
							
							$user 				= new User();
							$user->username 	= $oauth['screen_name'];
							$user->firstname 	= $me->name;
							$user->photo 		= $me->profile_image_url;
							$user->save();
							
							$profile 		= new Profile();
							$profile->uid 	= $oauth['user_id'];							
							$profile->type 	= 'twitter';
							$profile 		= $user->profiles()->save($profile);
						}
						
						$profile->access_token 			= $oauth['oauth_token'];
						$profile->access_token_secret 	= $oauth['oauth_token_secret'];
						
						$profile->save();
					
						$user = $profile->user;
							
						Auth::login($user);
							
						return Redirect::to('/')
							->with('message', 'Logged in with Twitter');
						
					} else {
				
						return Redirect::to('/users/twitter/logout');												
					}
				}								
			break;
						
			default:				
				$twitter_con = new TwitterOAuth(
					Config::get('twitter.twitter_consumer_token'),
					Config::get('twitter.twitter_consumer_secret')
				);
				
				if (Session::get('access_token') AND Session::get('access_token_secret')) {
					Redirect::to('/');
				} else {
												
					$request_token = $twitter_con->getRequestToken(Config::get('twitter.twitter_callback_url'));
									
					Session::set('twitter_oauth_token', $request_token['oauth_token']);
					Session::set('twitter_oauth_token_secret', $request_token['oauth_token_secret']);
					
					switch ($twitter_con->http_code) {
						case 200:
							return Redirect::to($twitter_con->getAuthorizeURL($request_token));							
						break;
						
						default:
							return "Could not connect to Twitter, Refresh the page or try later.";
					}					
				}
		}
	}		
}