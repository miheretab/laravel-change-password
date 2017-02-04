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
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<style>
    html, body {
        height: 100%;
    }

    .navmenu {
        padding-top: 50px;
    }

    .navbar {
        display: block;
        text-align: center;
    }

    .navbar-brand {
        display: inline-block;
        float: none;
        padding: 15px 0 0 0;
    }

    .navbar-toggle {
        position: absolute;
        float: left;
        margin-left: 15px;
    }

    .container {
        max-width: 100%;
    }

    .content {
        margin-top: 60px;
    }

    @media (min-width: 1px) {
        .navbar-toggle {
            display: block !important;
        }

        .widescreen-navbar {
            display: none;
        }
    }

    @media (min-width: 992px) {
        body {
            padding: 0 0 0 300px;
        }

        .navmenu {
            padding-top: 0;
        }

        .navbar {
            display: none !important; /* IE8 fix */
        }

        .widescreen-navbar {
            display: block;
            text-align: center;
            border-bottom: 1px solid #d3e0e9;
            position: fixed;
            top: 0;
            right: 0;
            left: 300px;
            z-index: 1;
        }

        {{-- Don't show the 'menu button' in widescreen mode --}}
        .navbar-toggle {
            display: none !important;
        }
    }
</style>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
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
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
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

        {{-- If we have a form action defined, then wrap the navbar and content in a form element --}}
        @if (isset($formAction))
            <form action="{{$formAction}}" method="POST">
                @endif

                {{-- This is shown on a narrower screen --}}
                <div class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg">
                    @yield('left-navbar-button')
                    <span class="navbar-brand">@yield('title')</span>
                    @yield('right-navbar-button')
                </div>


                <!-- Page Content -->
                <div class="container-fluid">

                    {{-- This 'widescreen-navbar' is only shown on a wider screen --}}
                    <div class="widescreen-navbar navbar-default">
                        @yield('left-navbar-button')
                        <span class="navbar-brand">@yield('title')</span>
                        @yield('right-navbar-button')
                    </div>

                    <div class="content">
                    @yield('content')

                    <!-- Form Error List -->

                        @if(env('APP_ENV') === 'local' && count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Debug info (only shown in 'local' environment)</strong>

                                <br><br>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                @if (isset($formAction))
            </form>
        @endif
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
