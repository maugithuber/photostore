<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/file.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    {{--<nav class="navbar navbar-default navbar-static-top">--}}
    <nav class="navbar navbar-default navbar-static-top navbar  ">
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
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <i class="fa fa-camera" aria-hidden="true"></i> PhotoStore
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
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li>
                            <a class="fa fa-picture-o" aria-hidden="true" href="{{route('myphotos')}}"> My photos </a>
                        </li>
                        <li>
                            <a href="{{url('shopping')}}">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
                                <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : ''   }}</span>
                            </a>
                        </li>
                        {{--<li class="dropdown">--}}
                            {{--<a  class="fa fa-calendar"   class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                                {{--EVENTS<span class="caret"></span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li>--}}
                                    {{--<a class="fa fa-picture-o" aria-hidden="true" href="{{route('myphotos')}}"> My events </a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a class="fa fa-picture-o" aria-hidden="true" href="{{route('myphotos')}}"> Public events </a>--}}
                                {{--</li>--}}

                            {{--</ul>--}}
                        {{--</li>--}}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                               style="position:relative;padding-left: 50px">

                                {{ Auth::user()->name }} <span class="caret"></span>
                                <img src="https://s3.amazonaws.com/photovirginia/{{Auth::user()->photo }}" style="width: 32px;height: 32px;position: absolute;
                                    top: 10px;left: 10px;border-radius:50% ">
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href=" {{ url('/profile') }}">
                                        <i class="fa fa-user" aria-hidden="true"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="fa fa-sign-out" aria-hidden="true"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://use.fontawesome.com/38be773582.js"></script>
</body>
</html>
