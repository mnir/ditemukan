@extends('layout.master')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3 class="fw3 ls-1 tx-uc">Daftar Ditemukan</h3>
			<div class="item-list box-white pd20 clearfix">
				@foreach ($items as $item)
					<div class="col-md-6 item clearfix">
						<a href="{{ URL::to('items/show/'.$item->id) }}">
							<div class="item-image">
								{{ HTML::image('upload/items/covers/'.$item->image, 'Image', array('class'=>'img-responsive')) }}
							</div>
							<div class="item-desc">
								<div class="item-desc-header">
									<h4><strong>{{{ $item->title }}}</strong></h4>
									<p>
										<small>
											{{{ $item->user->first_name.' '.$item->user->last_name }}} |
											{{ $item->city->name }}
										</small>
									</p>
								</div>
								<div class="item-desc-body">
									<p class="item-desc-intro">{{ str_limit($item->description, 60, ' ...') }}</p>
									<p class="date-created">{{ date("j M Y", strtotime($item->created_at)) }}</p>
								</div>
							</div>
						</a>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@stop