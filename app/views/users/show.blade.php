@extends('layout.master')
@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-condensed">
				<tr>
					
					<td>Username</td>
					<td>{{ $user->username }}</td>
					
				</tr>	
				<tr>
				
					<td>Nama Depan</td>
					<td>{{$user->first_name}}</td>
					
				</tr>
				<tr>
				
					<td>Nama Belakang</td>
					<td>{{$user->last_name}}</td>
					
				<tr>
				
					<td>Email</td>
					<td>{{$user->email}}</td>
				
				</tr>
				<tr>
				
					<td>Aktif</td>
					<td>@if($user->activated === 1)
							Ya
						@else
							Tidak
						@endif
					</td>
				</tr>
												
			</table>
		</div>
	</div>	
</div>

@stop