@extends('layout.master')
@section('content')

<div class="container">
	<div class="col-md-6 col-md-offset-3">
		<div id="login-form">
			@if(Session::has('message'))
				<span class="alert alert-info">{{ Session::get('message') }}</span>
			@endif
			<div class="login-form-header">
				<h2>Login</h2>
			</div>
			<div class="login-form-body">
				{{ Form::open(array('url'=>'users/login', 'class'=>'form-horizontal')) }}

				<div class="form-group">
					<label for="email" class="control-label col-md-4">Email</label>
					<div class="col-md-8">
						{{ Form::email('email', null, array('class'=>'form-control', 'id'=>'email'))  }}
						{{ $errors->first('email') }}
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="control-label col-md-4">Password</label>
					<div class="col-md-8">
						{{ Form::password('password', array('class'=>'form-control', 'id'=>'password'))  }}
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-8 col-md-offset-4">
						{{ Form::submit('Login', array('class'=>'btn btn-primary')) }}
						{{ Form::button('Facebook', array(
							'class'=>'btn btn-primary',
							'onclick' => 'window.location.href=\'facebook\''
						)) }}
						{{ Form::button('Twitter', array(
							'class'=>'btn btn-primary',
							'onclick' => 'window.location.href=\'twitter\''
						)) }}
					</div>
				</div>

				{{ HTML::link('users/create', 'Buat akun') }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop