@extends('layout.master')
@section('content')

<div id="logo">
	<img src="{{ URL::to('/') }}/assets/img/layout/logo.png" alt="ditemukan.org logo">
	<h2>ditemukan.org</h2>
	<p>
		ditemukan.org adalah aplikasi web dengan tujuan sosial.<br>
		Proyek ini bersifat terbuka dan dikerjakan secara sukarela oleh para kontributor.
		Jika berminat untuk membantu mengembangkan proyek ini, silahkan kunjungi:
	</p>
	<a class="btn btn-xs btn-primary" href="http://www.kaskus.co.id/thread/531b38f841cb17e66e8b45cb/non-profit-mencari-developer-untuk-ditemukanorg/8">
		Kaskus Thread
	</a>
	<a class="btn btn-xs btn-info" href="https://github.com/detikpw/ditemukan">
		gitHub
	</a>
	<a class="btn btn-xs btn-danger" href="https://plus.google.com/109324412661501708233/posts">
		Google+
	</a>
</div>

@stop