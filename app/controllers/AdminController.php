<?php

class AdminController extends BaseController {
	
	
	/**
	 * 
	 * GET /user
	 */
	/* public function index() {
		if (! Sentry::check()) {
			return Redirect::to('/');
		}
		
		$users = User::all();
		return View::make('users.manage')->with('users',$users);		
	} */
	
	/**
	 *
	 * @param integer $id
	 * DELETE /user/{:id}
	 */
	/* public function destroy($id) {
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
	} */
	
	/**
	 *
	 * @param integer $id
	 * GET /user/{:id}/edit
	 */
	/* public function edit($id) {
	 if (! Sentry::check()) {
	return Redirect::to('/'); // redirect ke halaman akun
	}
	
	$user = User::find($id);
	
	return View::make('users.edit')->with('user',$user);;
	} */
	
	/**
	 *
	 * @param integer $id
	 * GET /user/{:id}
	 */
	/* public function show($id) {
	 if (! Sentry::check()) {
	return Redirect::to('/');
	}
	
	$user = User::find($id);
	
	return View::make('users.show')
	->with('user',$user);
	} */
	
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
}