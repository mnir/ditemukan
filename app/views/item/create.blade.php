@extends('layout.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Input Data Barang Hilang</h1>
			{{ Form::open(['url'=>'item/create' , 'class'=>'form-horizontal']) }}

			<div class="form-group">
				<label for="events" class="control-label col-md-4">Status barang</label>
				<div class="col-md-8">
					<select name="events" id="event" class="form-control">
						<option value="1">Hilang</option>
						<option value="2">Ditemukan</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="city" class="control-label col-md-4">Kota</label>
				<div class="col-md-8">
					<select name="city" id="city" class="form-control">
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
				<div class="col-md-8 col-md-offset-4">
					{{ Form::submit('Simpan', ['class'=>'btn btn-primary']) }}
				</div>
			</div>

			{{ Form::close() }}
		</div>
	</div>
</div>

@stop