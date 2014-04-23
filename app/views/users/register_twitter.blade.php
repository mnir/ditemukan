@extends('layout.master')
@section('content')

<div class="container">
	<div class="col-md-6 col-md-offset-3">
		<div id="login-form">
			<div class="login-form-header">
				<h2>Buat akun</h2>
			</div>
			<div class="login-form-body">
				{{ Form::open(array('url'=>'users/create', 'class'=>'form-horizontal')) }}

				<div class="form-group">
					<label for="firstname" class="control-label col-md-4">Username</label>
					<div class="col-md-8">
						{{ Form::text('username', null, array('class'=>'form-control', 'id'=>'username')) }}
						{{ $errors->first('username') }}
					</div>
				</div>

				<div class="form-group">
					<label for="firstname" class="control-label col-md-4">Nama depan</label>
					<div class="col-md-8">
						{{ Form::text('firstname', null, array('class'=>'form-control', 'id'=>'firstname')) }}
						{{ $errors->first('firstname') }}
					</div>
				</div>

				<div class="form-group">
					<label for="lastname" class="control-label col-md-4">Nama belakang</label>
					<div class="col-md-8">
						{{ Form::text('lastname', null, array('class'=>'form-control', 'id'=>'lastname'))  }}
						{{ $errors->first('lastname') }}
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="control-label col-md-4">Email</label>
					<div class="col-md-8">
						{{ Form::text('email', null, array('class'=>'form-control', 'id'=>'email'))  }}
						{{ $errors->first('email') }}
					</div>
				</div>				

				<div class="form-group">
					<div class="col-md-8 col-md-offset-4">
						{{ Form::submit('Register', array('class'=>'btn btn-primary')) }}
					</div>
				</div>

				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>

@stop