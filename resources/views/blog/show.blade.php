<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Template --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Bootstrap style -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    {{-- End Template --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/main">
                    HOME
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <li style="margin-right: 15px; font-size: 15px; letter-spacing: 4px; font-weight: bold">
                            <a class="nav-link" href="/blog">Blog</a>
                        </li>

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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
        <div >
            <h1 style="text-align: center; font-size: 40px ;border: solid 1px rgb(134, 136, 4);margin-bottom: 20px">
                Show Post 
            </h1>

            @if(session()->has('message'))
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    <div>
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif
            
        </div>
        <main class="py-4 ">
            <div class="row tm-margin-t-big">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="tm-2-col-left">

                        <h3 class="tm-gold-text tm-title">{{ $posts->title }}</h3>
                        <img src="/image_for_web/{{ $posts->image }}" alt="Image"
                            class="tm-margin-b-40 img-fluid">
                        Created by :<span style="color: red">{{ $posts->user->name }}</span><br>
                        Created at :<span
                            style="color: red">{{ date('d-m-Y', strtotime($posts->updated_at)) }}</span>
                        <p>
                            {{ $posts->content }}
                        </p>

                        @if(Auth::user() && Auth::user()->id == $posts->user_id)
                            <div>
                                <a href="/blog/{{ $posts->id }}/edit" class="tm-btn text-uppercase">Edit Post</a>
                            </div>

                            <form action="/blog/{{ $posts->id }}" method="post">
                                @csrf
                                @method('delete')

                                <button type="submit">Delete Post</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div> <!-- row -->
        </main>



    </div>
</body>
</html>
