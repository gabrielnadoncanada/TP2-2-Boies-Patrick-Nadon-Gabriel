@extends('layouts.app')
@section('content')

<div class="container mt-5">
<form class="mb-5" method="POST" action="/searchResult">
        @csrf
            <input class=" form-control" id="location" name="location" placeholder="Recherche par lieux" type="text" autocomplete="off">
</form>

<div class="card-columns">
            @foreach($images as $image)
                <div class="card" id="image{{ $image->id }}">
                    <a href="{{ url('images/' . $image->name) }}" class="image-link">
                        <img class="card-img-top"
                             src="{{ url('thumbs/' . $image->name) }}"
                             alt="image">
                    </a>
                
                    <div class="card-footer text-muted">
                        <div>
                            <h4 class="mb-3">{{ $image->location->name }}</h4>
                        </div>
                        <em>
                            <a href="#" data-toggle="tooltip"
                               title="{{ __('Voir les photos de ') . $image->user->name }}">{{ $image->user->name }}</a>
                        </em>
                        <div class="pull-right">
                            <em>
                                {{ $image->created_at->formatLocalized('%x') }}
                            </em>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center my-5">
           
           {{ $images->links() }}
        </div>
    </div>

    @section('script')
    <script>
     $(() => {
            $('[data-toggle="tooltip"]').tooltip()
            $('.card-columns').magnificPopup({
                delegate: 'a.image-link',
                type: 'image',
                tClose: '@lang("Fermer (Esc)")'@if($images->count() > 1),
                gallery: {
                    enabled: true,
                    tPrev: '@lang("Précédent (Flèche gauche)")',
                    tNext: '@lang("Suivant (Flèche droite)")'
                },
                callbacks: {
                    buildControls: function () {
                        this.contentContainer.append(this.arrowLeft.add(this.arrowRight))
                    }
                }@endif
            })
        });

  var route = "{{ url('autocomplete') }}";
            $('#location').typeahead({
                source:  function (term, process) {
                return $.get(route, { term: term }, function (data) {
                        return process(data);
                    });
                }
         });
    </script>
    @endsection