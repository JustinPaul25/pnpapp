<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PNP | App</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-800 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-gray-900 py-4">
            <div class="container mx-auto flex justify-between items-center px-3">
                <div>
                    <p class="text-xl font-bold text-yellow-500">PNP</p>
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register-user') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span>
                            <a href="{{ route('dashboard') }}" class="{{ Request::segment(1) == 'dashboard' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0  hover:text-white hover:underline mr-4">
                                Dashboard
                            </a>
                            <a href="{{ route('reports') }}" class="{{ Request::segment(1) == 'reports' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0  hover:text-white hover:underline mr-4">
                                Crime Reports
                            </a>
                            {{--<a href="{{ route('lot') }}" class="{{ Request::segment(1) == 'lot' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0 hover:text-white hover:underline mr-4">
                                Lots
                            </a>
                            <a href="{{ route('agent') }}" class="{{ Request::segment(1) == 'agents' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0 hover:text-white hover:underline mr-4">
                                Agents
                            </a>
                            <a href="{{ route('transaction') }}" class="{{ Request::segment(1) == 'transactions' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0 hover:text-white hover:underline mr-4">
                                Transactions
                            </a>
                            <a href="{{ route('user') }}" class="{{ Request::segment(1) == 'users' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0 hover:text-white hover:underline mr-4">
                                Users
                            </a>
                            <a href="{{ route('password') }}" class="{{ Request::segment(1) == 'password' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0 hover:text-white hover:underline mr-4">
                                Change Password
                            </a> --}}
                        </span>
                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>
        @yield('content')
    </div>
</body>
</html>