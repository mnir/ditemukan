@extends('layout.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>Daftar Barang Ditemukan</h2>
			<ul>
				@foreach ($items as $item)
					<li>
						{{{ $item->title }}}<br>
						{{{ $item->user->firstname.' '.$item->user->lastname }}}<br>
						{{ $item->city->name }}<br>
						{{ $item->description }}
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

@stop