<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    @livewireStyles
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

    <style>

        body {
            background-color: white;
        }
        /* TOASTR BUGFIX */
    #toast-container > div {
    opacity: 1;
    }
    .toast {
    font-size: initial !important;
    border: initial !important;
    backdrop-filter: blur(0) !important;
    }
    .toast-success {
    background-color: #51A351 !important;
    }
    .toast-error {
    background-color: #BD362F !important;
    }
    .toast-info {
    background-color: #2F96B4 !important;
    }
    .toast-warning {
    background-color: #F89406 !important;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a class="navbar-brand" href="{{ route('discussions.index') }}">
                    Notice Board
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="notifications">
                                <a href="{{ route('users.notifications') }}" type="button" class="btn mr-3 btn-sm btn-dark position-relative">
                                    <i class="fas fa-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{ auth()->user()->unreadNotifications->count() }}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (!in_array(request()->path(),['login','register', 'password/reset', 'email/reset']))
            <main class="container py-4">
                <div class="row">
                    <div class="col-md-4">
                        @auth
                        <a href="{{ route('discussions.create') }}" style="width: 100%" class="btn btn-success mb-3">Add Notice</a>
                            @else
                            <a href="{{ route('login') }}" style="width: 100%" class="btn btn-success mb-3">Sign In to add a Notice</a>
                        @endauth
                        <ul class="list-group">
                            @foreach ($channels as $channel)
                                <li class="list-group-item">
                                    <a href="{{ route('discussions.index') }}?channel={{ $channel->slug }}">{{ $channel->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        {{-- Admin Only section --}}
                        @auth
                        <ul class="list-group mt-4">
                            @auth
                                <li class="list-group-item">
                                    <a href="{{ route('users.notifications') }}">Notifications</a>
                                </li>
                            @endauth
                            @if (Auth::user()->isAdmin())
                                <li class="list-group-item">
                                    <a href="{{ route('users.list') }}">Users</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('pending-notices') }}">Unapproved Notices</a>
                                </li>
                            @endif
                        </ul>
                        @endauth
                    </div>
                    <div class="col-md-8">
                        @yield('content')
                    </div>
                </div>
            </main>
        @else
        <main class="container py-4">
           @yield('content')
        </main>
        @endif
        
    </div>
    @yield('js')
    @livewireScripts
    <!-- Toastr Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/cc2d68ad86.js" crossorigin="anonymous"></script>
    
        @if(Session::has('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
        @endif

        <script>
            window.livewire.on('alert', param => {
                toastr[param['type']](param['message']);
            });
        </script>
    
</body>
</html>
