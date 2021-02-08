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
                <nav class="flex space-x-4 text-gray-300 text-sm sm:text-base">
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register as Complainant') }}</a>
                        @endif
                    @else
                        <span>
                            <a href="{{ route('home') }}" class="{{ Request::segment(1) == 'home' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0  hover:text-white hover:underline mr-4">
                                Dashboard
                            </a>
                            <a href="{{ route('reports') }}" class="{{ Request::segment(1) == 'reports' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0  hover:text-white hover:underline mr-4">
                                Crime Reports
                            </a>
                            <a href="{{ route('users') }}" class="{{ Request::segment(1) == 'users' ? 'underline font-bold text-yellow-500' : 'text-white' }} block mt-4 lg:inline-block lg:mt-0 hover:text-white hover:underline mr-4">
                                Users
                            </a>
                        </span>
                        <div class="relative group">
                            <button class="flex flex-row items-center w-full text-base font-bold text-left uppercase bg-transparent rounded-lg md:w-auto md:inline md:mt-0 md:ml-4 focus:outline-none font-montserrat">
                                <span>My Account</span>
                            </button>
                            <div class="absolute z-10 hidden bg-grey-200 group-hover:block bg-gray-800 w-full">
                                <div class="px-2 pt-2 pb-2 shadow-lg hover:bg-yellow-500 hover:text-gray-800">
                                    <div class="flex w-full">
                                      <p class="ml-auto">
                                          <a href="{{ route('logout') }}"
                                          class="text-xs no-underline hover:underline">{{ __('Settings') }}</a>
                                      </p>
                                    </div>
                                </div>
                                <div class="px-2 pt-2 pb-2 shadow-lg hover:bg-yellow-500 hover:text-gray-800">
                                    <div class="flex w-full">
                                      <p class="ml-auto">
                                          <a href="{{ route('logout') }}"
                                          class="text-xs no-underline hover:underline">{{ __('Change Password') }}</a>
                                      </p>
                                    </div>
                                </div>
                                <div class="px-2 pt-2 pb-2 shadow-lg hover:bg-yellow-500 hover:text-gray-800 rounded-b-lg">
                                  <div class="flex w-full">
                                    <p class="ml-auto">
                                        <a href="{{ route('logout') }}"
                                        class="text-xs no-underline hover:underline"
                                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                         {{ csrf_field() }}
                                     </form>
                                    </p>
                                  </div>
                                </div>
                            </div>
                        </div> 
                    @endguest
                </nav>
            </div>
        </header>
        @yield('content')
    </div>
    <script>
        window.config = {
            user: "{{ auth()->check() ? auth()->user()->id : null }}"
        };
    </script>
</body>
</html>