<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lightest h-screen font-sans">
    <div id="app">
        <nav class="bg-white h-16 shadow mb-6 px-6 md:px-0 border-t-4 border-red">
            <div class="container mx-auto">
                <div class="flex flex-auto justify-between items-center mt-4">
                    <div class="mr-6">
                        <a href="{{ url('/') }}" class="no-underline mr-8 text-2xl text-red-darkest font-semibold">
                            FIFA WC 2018
                        </a>
                        @if(Auth::check())
                        <a href="{{ url('predictions') }}" class="no-underline text-grey-darker hover:text-black mx-2 text-lg {{ Request::is('predictions') ? 'border-red border-b-2' : '' }}">
                            Predictions
                        </a>
                        <a href="{{ url('fixtures') }}" class="no-underline text-grey-darker hover:text-black mx-2 text-lg {{ Request::is('fixtures') ? 'border-red border-b-2' : '' }}">
                            Fixtures
                        </a>
                        <a href="{{ url('leader-board') }}" class="no-underline text-grey-darker hover:text-black mx-2 text-lg {{ Request::is('leader-board') ? 'border-red border-b-2' : '' }}">
                            Leader board
                        </a>
                        @endif
                    </div>
                    <div class="flex-1 text-right">
                        @guest
                            <!-- <a class="no-underline hover:underline text-grey-darker pr-3 text-sm" href="{{ url('/login') }}">Login</a>
                            <a class="no-underline hover:underline text-grey-darker text-sm" href="{{ url('/register') }}">Register</a> -->
                        @else
                            <span class="text-grey-darker text-sm pr-4 text-lg">{{ ucfirst(Auth::user()->name) }}</span>

                            <a href="{{ route('logout') }}"
                                class="no-underline hover:underline text-grey-darker text-sm text-lg"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
