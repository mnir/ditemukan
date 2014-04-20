@extends('layout.master')
@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-condensed">
				<tr>
					<th>No</th>
					<th>Username</th>
					<th>Nama Depan</th>
					<th>Nama Belakang</th>
					<th>Email</th>
					<th>Aktif</th>
					<th>Aksi</th>
				</tr>				
				
				@foreach($users as $user)
				<?php $i=1; ?>
				<tr>
					<td>{{$i}}</td>
					<td>{{$user->username}}</td>
					<td>{{$user->first_name}}</td>
					<td>{{$user->last_name}}</td>
					<td>{{$user->email}}</td>
					<td>
						@if($user->activated === 1)
							Ya
						@else
							Tidak
						@endif
					</td>
					<td>{{ HTML::link('user/'.$user->id,'Show') }}
						{{ HTML::link('user/'.$user->id.'/edit','Edit') }} 
						{{ Form::open(array(
							'url' => 'user/' . $user->id, 
							'class' => 'pull-right',
							'method' => 'DELETE')) 
						}}							
							{{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
						{{ Form::close() }}
					</td>
				</tr>
				<?php $i++; ?>
				@endforeach
			</table>
		</div>
	</div>	
</div>

@stop