@extends('layout.master')
@section('content')

<div class="container">
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th class="span1">Id</th>
					<th class="span2">Nama Pertama</th>
					<th class="span2">Nama Kedua</th>
					<th class="span3">Email</th>
					<th class="span2">Activated</th>
					<th class="span2">Created At</th>
					<th class="span2">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->first_name }}</td>
					<td>{{ $user->last_name }}</td>
					<td>{{ $user->email }}</td>
					<td>@lang('general.' . ($user->isActivated() ? 'yes' : 'no'))</td>
					<td>{{ $user->created_at->diffForHumans() }}</td>
					<td>
						<a href="#" class="btn btn-mini">@lang('button.edit')</a>
		
						@if ( ! is_null($user->deleted_at))
						<a href="#" class="btn btn-mini btn-warning">@lang('button.restore')</a>
						@else
						@if (Sentry::getUser()->id !== $user->id)
						<a href="#" class="btn btn-mini btn-danger">@lang('button.delete')</a>
						@else
						<span class="btn btn-mini btn-danger disabled">@lang('button.delete')</span>
						@endif
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop