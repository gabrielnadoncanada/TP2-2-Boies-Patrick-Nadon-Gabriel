<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel-TP2') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav id="main-header" class="custom_nav navbar navbar-expand-lg navbar-light bg-secondary">
            <a class="navbar-brand text-white" href="{{ route('home') }}">La Album</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">@lang('Connexion')</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">@lang('Inscription')</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('location.create') }}">
                            @lang('Ajouter un lieu')
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('image.create')}}">
                            @lang('Ajouter une image')
                        </a>
                    </li>
                    @endauth
                    @if(Auth::check() && Auth::user()->role == "admin")
                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.users') }}">
                                @lang('Liste des utilisateurs')
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.locations') }}">
                                @lang('Liste des lieux')
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.reported') }}">
                                @lang('Images innapropriés')
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                @lang('Me déconnecter')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    </ul>
                    @include('components.form-search')      
                    @else
                    @auth
                    <li class="nav-item dropdown mr-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.edit', Auth::user()->id) }}">
                                @lang('Mon profil')
                            </a>
                            <a class="dropdown-item" href="{{ route('user_images', Auth::user()->id) }}">
                                @lang('Mes photos')
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                @lang('Me déconnecter')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    </ul>
                @include('components.form-search')
@endauth
@endif
            </div>
        </nav>
        <main class="pt-5 mt-5">
            <div class="container">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                @yield('content')
            </div>
        </main>
        <!-- Scripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.11.1/dist/sweetalert2.all.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        @yield('script')
        <script>
            // autocomplete user input in the search box
            var route = "{{ url('autocomplete') }}";
            $('#location').typeahead({
                source: function(term, process) {
                    return $.get(route, {
                        term: term
                    }, function(data) {
                        return process(data);
                    });
                }
            });

             //Fonction pour "cliquer" sur sélectionner un choix dans la <div> de suggestions
            $("#location").on("click", "span", function (e) {

            if ($("#search-box").val($(this).html())) {
            $("#search").click();
            }

            });
            </script>
</body>

</html>
