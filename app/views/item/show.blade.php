@extends('layout.master')
@section('content')

<div class="container">
	<div class="col-md-6">
		@foreach ($items as $item)
			<h1>{{{ $item->title }}}</h1>
			<p>{{{ $item->description }}}</p>
			<p>{{{ $item->user->firstname.' '.$item->user->lastname }}} / {{ date("j M Y", strtotime($item->created_at)) }}</p>
		@endforeach
	</div>
	<div class="col-md-6">
		@if ($images->count() > 0)
			@foreach ($images as $image)
				{{ HTML::image('upload/items/thumbs/'.$image->path) }}
			@endforeach
		@endif
	</div>
</div>

@stop