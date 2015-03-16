<nav class="navbar navbar-default mgb0" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('/') }}">{{ HTML::image('assets/img/layout/logo-top.png') }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="first">{{ HTML::link('items/found', 'Ditemukan') }}</li>
                <li>{{ HTML::link('items/lost', 'Kehilangan') }}</li>
                <li>{{ HTML::link('items/create', 'Laporkan') }}</li>
                {{-- <li>{{ HTML::link('items/create', 'Masukkan informasi baru') }}</li> --}}
            </ul>
            {{-- <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Cari...">
                </div>
                <button type="submit" class="btn btn-default">Cari</button>
            </form> --}}
            @if(Sentry::check())
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ URL::to('users/show/' . Sentry::getUser()->id) }}">Profil</a></li>                
            </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if(Sentry::check())
                <li><a href="{{ URL::to('users/logout') }}">Logout</a></li>
                @else
                <li><a href="{{ URL::to('users/login') }}">Login / daftar</a></li>
                {{-- <li><a href="{{ URL::to('users/create') }}">Daftar</a></li> --}}
                @endif
            </ul>            
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>