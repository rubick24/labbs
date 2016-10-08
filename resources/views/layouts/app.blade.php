<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href=" {{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel='stylesheet' href="{{ asset('css/nprogress.css') }}"/>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="{{ asset('/js/njquery.pjax.js') }}"></script>
    <script src="{{ asset('/js/nprogress.js') }}"></script>
    <script>
        $(document).ready(function()
        {
            $(document).pjax('a', 'body');

            $(document).on('pjax:start', function() {
                NProgress.start();
            });
            $(document).on('pjax:end', function() {
                NProgress.done();
//                self.siteBootUp();
            });
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <form method="get" action="{{ url('/search') }}" class="navbar-form navbar-left" role="search">
                    <div class="form-group form-group-sm" style="padding-top: 3px">
                        <div class="input-group input-group-sm">
                            <input name="text" type="text" class="form-control" placeholder="Search"  autocomplete="off">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                      </div>
                </form>

                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                    <li><a href="{{ url('/article') }}">Article</a></li>
                    <li><a href="{{ url('/category') }}">Category</a></li>
                    @if(Auth::check()&&Auth::user()->hasRole('owner'))
                        <li><a href="{{ url('/owner') }}">Dashboard</a></li>
                    @endif
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user/'.Auth::user()->id) }}">Profile</a></li>
                                <li><a href="{{ url('/messages') }}">Messages
                                        @if(\App\Message::read(Auth::id(),false)->count()!=0)
                                            <span class="badge">{{ \App\Message::read(Auth::id(),false)->count() }}</span>
                                        @endif
                                    </a></li>
                                <li><a href="{{ url('/settings') }}">Settings</a></li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div style="min-height: 350px;padding: 25px 0">
        @yield('content')
    </div>


    <div style="height: 160px;width: 100%;text-align: center" >
        <hr>
        <p style="padding: 24px 0">Hand crafted with love by me</p>
    </div>
