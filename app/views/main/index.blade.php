@extends('layout.master')
@section('content')

<div class="container">
	<div id="bumper">
		<img src="{{ URL::to('/') }}/assets/img/layout/logo.png" alt="ditemukan.org logo">
		<h2>ditemukan.org</h2>
		{{ HTML::link('losts', 'Hilang', ['class'=>'btn btn-primary']) }}
		{{ HTML::link('founds', 'Ditemukan', ['class'=>'btn btn-primary']) }}
	</div>
</div>

@stop