<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    

    <style>
    
    .float-btn {
        display: inline;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        font-size: 2em;
        font-weight: bold;
        margin-bottom: 50px;
        margin-left: 20px;
    }

    .float-btn::after, .float-btn::before {
        position: absolute;
        content: "";
        background-color: white;
        width: 3px;
        height: 20px;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
    }
    .float-btn::after {
        width: 20px;
        height: 3px;
        
    }

    h5 a:hover {
        text-decoration: none;
    }

    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .rodape {
        margin-top: 50px;
        width: 100%;
    }
    @media (min-width: 992px) { 
        .rodape {            
            bottom: 0;
            width: 100%;
        }
    }

    .lead {
        display: inline-block;
        margin-top: -50px;
    }

    .txt-user:hover, .txt-user:active, .txt-user:focus {
        color: white !important;
    }
    .txt-user {
        color: #3490dc !important;
    }
    
    </style>




</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('imgs/logo.png') }}" width="120px">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-outline-primary px-3 txt-user" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (Auth::check())
            <button type="button" class="btn btn-primary fixed-bottom float-btn shadow" data-toggle="modal" data-target="#newNote"></button>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary fixed-bottom float-btn shadow"></a>
            @endif
            @yield('content')
        </main>
        <div class="links position-absolute mb-5 text-center rodape">
            <a href="https://github.com/stthrudell/app-notas" target="_blank">Feito com ♥ | Github </a>
        </div>        
    </div>

    <!-- Modal -->
        <div class="modal fade" id="newNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Criar uma nova nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ route('notas.store') }}">
                    @csrf
                    <div class="input-group flex-nowrap mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">Título</span>
                        </div>
                        <input type="text" name="title" class="form-control" placeholder="Insira o título da nota" aria-label="Username" aria-describedby="addon-wrapping" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="text" placeholder="Sua nota..." required></textarea>
                    </div>
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Visibilidade</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="is_public">
                            <option value="0" selected>Privado</option>
                            <option value="1">Público</option>
                        </select>
                    </div>                
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Criar</button>                
                </form>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>
