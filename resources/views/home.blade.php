@extends('layouts.app')
@section('content')
<main class="container">
   
    @isset($location)
    <h2 class="text-title mb-3">{{ $location->name }}</h2>
    @endif
    @isset($user)
    <h2 class="text-title mb-3">{{ __('Photos de ') . $user->name }}</h2>
    @endif
   
    <div class="card-columns">
        @foreach($images as $image)
        <div class="card" id="image{{ $image->id }}">
            <a href="{{ url('images/' . $image->name) }}" class="image-link">
                <img class="card-img-top" src="{{ url('thumbs/' . $image->name) }}" alt="image">
            </a>
            <div class="card-footer text-muted">
                <div>
                    {{ $image->location->name }}
                </div>
                <em>
                    <a href="{{ url('user/' . $image->user_id . '/images') }}" data-toggle="tooltip" title="{{ __('Voir les photos de ') . $image->user->name }}">{{ $image->user->name }}</a>
                </em>
                <div class="pull-right">
                    <em>
                        {{ $image->created_at->formatLocalized('%x') }}
                    </em>
                </div>
                <div class="pull-right">
                    <form class="flag" method="POST" action="{{ url('imagesFlag/'.$image->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <button class="btn btn-warning mt-3" type="submit" data-toggle="tooltip" title="@lang('Signaler cette image')">
                        <i class="fas fa-flag fa-lg"></i>
                        </button>
                    </form>
                    @if ($image->user_id === Auth::user()->id or Auth::user()->role == "admin")
                        @include('partials.delete')
                    @endif    
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center my-5">
        {{ $images->links() }}
    </div>
</main>
@endsection

@section('script')
<script>
   
    // custom lightbox
    $(() => {
        $('[data-toggle="tooltip"]').tooltip()
        $('.card-columns').magnificPopup({
            delegate: 'a.image-link',
            type: 'image',
            tClose: '@lang("Fermer (Esc)")'
            @if($images-> count() > 1),
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
    });

</script>
@endsection    