<?php

/**
 * 
 * @author mnir, Einstein2009
 */
class UsersController extends BaseController {
	
	/**
	 * 
	 * GET /user
	 */
	public function index() {
		if (! Sentry::check()) {
			return Redirect::to('/');
		}
		
		$users = User::all();
		return View::make('users.manage')->with('users',$users);		
	}
	
	/**
	 *
	 * GET /user/create
	 */	
	public function create()
	{
		// Sentry check
		if (Sentry::check()) {
			return Redirect::to('/'); // redirect ke halaman akun
		}
		return View::make('users.create');
	}
	
	/**
	 *
	 * @param integer $id
	 * DELETE /user/{:id}
	 */
	public function destroy($id) {
		try
		{
			// Get user information
			$user = Sentry::getUserProvider()->findById($id);

			// Check if we are not trying to delete ourselves
			if ($user->id === Sentry::getId())
			{
				// Prepare the error message
				$error = 'Error';

				// Redirect to the user management page
				return Redirect::to('users')->with('error', $error);
			}

			// Do we have permission to delete this user?
			if ($user->isSuperUser() and ! Sentry::getUser()->isSuperUser())
			{
				// Redirect to the user management page
				return Redirect::to('users')->with('error', 'Insufficient permissions!');
			}

			// Delete the user
			$user->delete();

			// Prepare the success message
			$success = 'Success';

			// Redirect to the user management page
			return Redirect::to('users')->with('success', $success);
		}
		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = 'user not found';

			// Redirect to the user management page
			return Redirect::to('users')->with('error', $error);
		}
	}
	
	/**
	 *
	 * @param integer $id
	 * GET /user/{:id}/edit
	 */
	public function edit($id) {
		if (! Sentry::check()) {
			return Redirect::to('/'); // redirect ke halaman akun
		}
		
		$user = User::find($id);
		
		return View::make('users.edit')->with('user',$user);;
	}
	
	/**
	 *
	 * @param integer $id
	 * GET /user/{:id}
	 */
	public function show($id) {
		if (! Sentry::check()) {
			return Redirect::to('/'); 
		}
		
		$user = User::find($id);
		
		return View::make('users.show')
				->with('user',$user);
	}
	
	/**
	 *
	 * Register or create a user
	 * POST /user
	 */	
	public function store()
	{
		$validator = Validator::make(Input::all(), array(
			'username'	=> 'required|unique:users|alpha_num', // alpha_num: untuk memastikan tidak ada spasi
			'firstname' => 'required',
			'lastname'  => 'required',
			'email'     => 'required|email|unique:users',
			'password'  => 'required'
		));
	
		if($validator->fails())
		{
			return Redirect::to('users/create')->withErrors($validator)->withInput();
		}
		else
		{
			$user = Sentry::register(array(
					'username' => Input::get('username'),
					'first_name' => Input::get('firstname'),
					'last_name' => Input::get('lastname'),
					'email' => Input::get('email'),
					'password' => Input::get('password')
			), TRUE);
						
			return Redirect::to('users/login')->with('message', 'Akun anda telah dibuat, silahkan melakukan login.');
		}
	}

	/**
	 *
	 * @param integer $id
	 * PUT /user/{:id}
	 */
	public function update($id) 
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
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			$user = Sentry::getUser();
						
			$user->username = Input::get('username');
			$user->first_name = Input::get('firstname');
			$user->last_name = Input::get('lastname');
			$user->email = Input::get('email');			
			$user->save();
								
			return Redirect::to('user')->with('message', 'Akun anda telah diupdate.');
		}
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
				$user = Sentry::register(array(
					'username' 		=> $me['username'],
					'first_name' 	=> $me['first_name'],
					'last_name' 	=> $me['last_name'],
					'email' 		=> $me['email'],
					'password'		=> str_random(40)
				), TRUE);
					
				$profile = new Profile();
	
				$profile->user_id	= $user->id;
				$profile->uid 		= $uid;
				$profile->type 		= 'facebook';
				$profile->photo 	= 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';				
			}
				
			$profile->access_token	= $facebook->getAccessToken();
			$profile->save();
			
			$user = $profile->user;
			
			$thisUser = Sentry::findUserById($user->id);
			
			Sentry::login($thisUser, TRUE);
				
			return Redirect::to('/')
				->with('message', 'Logged in with Facebook');
		} 
		else 
		{
	
			$params = array(
					'redirect_uri' => url('/users/facebook/callback'),
					'scope' => 'email',
			);
				
			return Redirect::to($facebook->getLoginUrl($params));
		}
	}
	
	/**
	 * 
	 * GET /users
	 */
	public function getIndex() { return $this->index(); }
	
	
	public function getLogin()
	{
		if(Sentry::check())
		{
			return Redirect::to('/');
		}
		return View::make('users.login');
	}

	public function getLogout()
	{
		Sentry::logout();		
		return Redirect::to('/');
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
												
							$user = Sentry::register(array(
								'username' 		=> $oauth['screen_name'],
								'first_name' 	=> $me->name,							
								'password'		=> str_random(40)
							), TRUE);
								
							$profile 		= new Profile();
							
							$profile->user_id	= $user->id;
							$profile->uid 		= $oauth['user_id'];							
							$profile->type 		= 'twitter';
							$profile->photo		= $me->profile_image_url;						
						}
						
						$profile->access_token 			= $oauth['oauth_token'];
						$profile->access_token_secret 	= $oauth['oauth_token_secret'];
						
						$profile->save();
					
						$user = $profile->user;
			
						$thisUser = Sentry::findUserById($user->id);
						Sentry::login($thisUser, TRUE);
							
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

	
	/**
	 *
	 * Login process
	 */
	public function postLogin()
	{						
		if(filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL)) {
			$validator = Validator::make(Input::all(), array(
				'email' => 'required|email',
				'password' => 'required'
			));
			
			$loginid = Input::get('email');
		}
		else {
			$validator = Validator::make(Input::all(), array(
				'email' => 'required',
				'password' => 'required'
			));

			// https://github.com/cartalyst/sentry/issues/180#issuecomment-29557143
			$emptyModelInstance = Sentry::getUserProvider()->getEmptyUser();
			
			// Now, you have any methods available that you'd like. Retrieve a new instance, query
			// against anything. Because our User model implements the right interfaces, it plays nicely
			// with Sentry.
			$myUser = $emptyModelInstance->where('username', '=', Input::get('email'))->first();
				
			$loginid = $myUser->email;			
		}
	
		if($validator->fails())
		{
			return Redirect::to('users/login')->withErrors($validator)->withInput();
		}
	
		try {
			
			$credentials = array(
				'email'    => $loginid,
				'password' => Input::get('password'),
			);
			
			Sentry::authenticate(
				$credentials
			);
				
			return Redirect::to('/');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->messageBag->add('email', 'Account Not Found');
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			$this->messageBag->add('email', 'Account Not Activated');
		}
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
			$this->messageBag->add('email', 'Account Suspended');
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
			$this->messageBag->add('email', 'Account Banned');
		}
	
		return Redirect::back()->withInput()->withErrors($this->messageBag);			
	}
}