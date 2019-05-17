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
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-secondary">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel-TP2') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
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
                </ul>
                @endauth
                <ul class="navbar-nav ml-auto">

                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">@lang('Connexion')</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">@lang('Inscription')</a>
                    </li>
                    @endguest

                    @if(Auth::check() && Auth::user()->role == "admin")
                    <li class="nav-item dropdown">
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
                    @else
                    @auth
                    <li class="nav-item dropdown">
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
                    @endauth
                    @endif
                </ul>
            </div>
        </nav>
        <main class="pt-5 mt-5 ml-5">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
        </script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        @yield('script')
        <script>

            // prevent default click on the logout button
            $(() => {
                $('#logout').click((e) => {
                    e.preventDefault()
                    $('#logout-form').submit()
                })
                $('[data-toggle="tooltip"]').tooltip()
            })

            // return current user id to the modal
            $('.btn-edit-user').on('click', function() {
                var button = $(event.relatedTarget)
                var recipient = $(this).data('id')
                var path = "/user/" + recipient;
                $('form').attr('action', path)
            })

             // return current location id to the modal
            $('.btn-edit-location').on('click', function() {
                var button = $(event.relatedTarget)
                var recipient = $(this).data('id')
                var path = "/location/" + recipient;
                $('form').attr('action', path)
            })

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

            // flag the current images
            $('.flag').submit((e) => {
                e.preventDefault();
                let href = $(e.currentTarget).attr('action')
                if (confirm('Voulez-vous vraiment signaler?')) {
                    $.ajax({
                            url: href,
                            type: 'GET'
                        })
                        .done((data) => {
                            alert(data.message)
                        })
                        .fail((data) => {
                            alert("Échec du signalement de l'image")
                        })
                }
            })

            // custom lightbox
            $(() => {
                $('[data-toggle="tooltip"]').tooltip()
                $('.card-columns').magnificPopup({
                    delegate: 'a.image-link',
                    type: 'image',
                    tClose: '@lang("Fermer (Esc)")'
                    @if($images - > count() > 1),
                    gallery: {
                        enabled: true,
                        tPrev: '@lang("Précédent (Flèche gauche)")',
                        tNext: '@lang("Suivant (Flèche droite)")'
                    },
                    callbacks: {
                        buildControls: function() {
                            this.contentContainer.append(this.arrowLeft.add(this.arrowRight))
                        }
                    }
                    @endif
                })
            })
        </script>
</body>

</html>