@extends('layout.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-3">

		</div>
		<div class="col-md-6 box-white mgt20">
			<div class="col-md-8 col-md-offset-4">
				<h3 class="fw3 ls-1">Laporkan</h3>
			</div>
			{{ Form::open(['url'=>'items/create', 'files'=>'true', 'class'=>'form-horizontal']) }}

			<hr class="divider">

			<div class="form-group">
				<label for="events" class="control-label col-md-4">Status</label>
				<div class="col-md-8">
					<select name="events" id="event" placeholder="Status" class="form-control selectize">
						<option value=""></option>
						<option value="1">Hilang</option>
						<option value="2">Ditemukan</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="city" class="control-label col-md-4">Kota</label>
				<div class="col-md-8">
					<select name="city" id="city" placeholder="Kota" class="form-control selectize">
					<option value=""></option>
					@foreach ($cities as $c)
						<option value="{{ $c->id }}">{{ $c->name }}</option>
					@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="title" class="control-label col-md-4">Judul</label>
				<div class="col-md-8">
					{{ Form::text('title', null, ['class'=>'form-control']) }}
				</div>
			</div>

			<div class="form-group">
				<label for="desc" class="control-label col-md-4">Informasi</label>
				<div class="col-md-8">
					{{ Form::textarea('desc', null, ['class'=>'form-control']) }}
				</div>
			</div>

			<div class="form-group">
				<label for="desc" class="control-label col-md-4">Gambar</label>
				<div class="col-md-8">
					{{ Form::file('image', ['class'=>'form-control']) }}
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-8 col-md-offset-4">
					{{ Form::submit('Simpan', ['class'=>'btn btn-primary']) }}
				</div>
			</div>

			{{ Form::close() }}
		</div>
	</div>
</div>

@stop