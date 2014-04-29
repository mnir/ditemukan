@extends('layout.master')
@section('content')

<div class="container">
	<div class="col-md-4 col-md-offset-4 mgt20">
		<div id="login-form" class="box-white">
			@if(Session::has('message'))
				<span class="alert alert-info">{{ Session::get('message') }}</span>
			@endif
			<div class="login-form-header col-md-8 col-md-offset-4">
				<h4 class="tx-uc">Login</h4>
			</div>
			<div class="login-form-body">
				{{ Form::open(array('url'=>'users/login', 'class'=>'form-horizontal')) }}

				<div class="form-group">
					<label for="email" class="control-label col-md-4">Email</label>
					<div class="col-md-8">
						{{ Form::text('email', null, array('class'=>'form-control', 'id'=>'email'))  }}
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
						{{ Form::submit('Login', array('class'=>'btn btn-primary btn-sm')) }}
					</div>
				</div>

				<hr class="divider">

				<div class="form-group tx-c">
					<div class="col-md-8 col-md-offset-2">
						<h5 class="tx-uc mg0">Belum memiliki akun?</h5>
					</div>
				</div>

				<div class="form-group tx-c">
					<div class="col-md-8 col-md-offset-2">
						{{ HTML::link('users/create', 'Buat Akun', array('class'=>'btn btn-warning btn-sm form-control')) }}
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-8 col-md-offset-2">
						<h5 class="tx-uc mg0">atau Login menggunakan</h5>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-8 col-md-offset-4">

						<a class="btn-login-sosmed" href="#" onclick="window.location.href='facebook'">
							<img src="{{ URL::to('assets/img/layout/fb-logo.png') }}" alt="">
						</a>
						<a class="btn-login-sosmed" href="#" onclick="window.location.href='twitter'">
							<img src="{{ URL::to('assets/img/layout/twitter-logo.png') }}" alt="">
						</a>
						{{-- Form::button('Facebook', array(
							'class'=>'btn btn-login-facebook btn-sm',
							'onclick' => 'window.location.href=\'facebook\''
						)) --}}
						{{-- Form::button('Twitter', array(
							'class'=>'btn btn-login-twitter btn-sm',
							'onclick' => 'window.location.href=\'twitter\''
						)) --}}
					</div>
				</div>

				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop