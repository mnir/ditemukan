@extends('layout.master')
@section('content')

<div class="container">
	<div class="row box-blue hero-unit mg0">
		<div class="col-md-6 col-md-offset-3 fc-w">
			<h1 class="fw3 ls-1 tx-c">Berbagi informasi</h1>
			<p class="tx-c">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>

	<div class="row box-white mg0">
		<div class="col-md-5 col-md-offset-1 pd50">
			<h3 class="tx-uc fw3 ls-1">Laporkan</h3>
			<p>
				Anda menemukan atau mengalami kehilangan?<br>
				Kami akan membantu menyebarluaskan informasi yang anda berikan.
			</p>
			<a class="btn btn-primary btn-sm" href="{{ URL::to('items/create') }}">Laporkan Informasi</a>
		</div>
	</div>
</div>

@stop