<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'K2 Digital') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta name="description" content="">
    <meta name="author" content="Karona Srun">
    <meta name="generator" content="Hugo 0.84.0">
    <link rel="shortcut icon" href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5" type="image/x-icon">
    <link rel="apple-touch-icon" href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5" sizes="180x180">
    <link rel="icon" href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5" sizes="32x32" type="image/png">
    <link rel="icon" href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5" color="#7952b3">
    <link rel="icon" href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5">
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="img-responsive" width="30" src="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5" alt="logo" srcset="">
                    {{ config('app.name', 'K2 Digital') }} <i class="bi bi-app-indicator"></i>
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

        <main class="mt-5">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
