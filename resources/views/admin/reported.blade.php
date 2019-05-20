@extends('layouts.app')
@section('content')
<div class="container">
   
    <div class="row justify-content-center">
        <div class="col-md-8">
            @component('components.card')
            @if($images->count() === 0)
                @slot('title')
                     @lang('Aucune images signalé pour le moment')
                @endslot
                <a href="{{ route('home') }}" class="ml-auto btn btn-primary btn-sm" role="button" aria-disabled="true">@lang('Voir les images')</a>
            @else
                @slot('title')
                     @lang('Liste des images signalées pour le moment')
                @endslot
                <form class="delete" action="{{ route('admin.destroyMany') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger my-3">
                       Supprimer tout
                    </button>
                </form>
                @endif
            @endcomponent
        </div>    
    </div> 
   
    <div class="card-columns">
        @foreach($images as $image)
        <div class="card bg-dark" id="image{{ $image->id }}">
            <a href="{{ url('images/' . $image->name) }}" class="image-link">
                <img class="card-img-top" src="{{ url('thumbs/' . $image->name) }}" alt="image">
            </a>
            <div class="card-footer text-muted">
                <div>
                    {{ $image->location->name }}
                </div>
                <em>
                    <a href="#" data-toggle="tooltip" title="{{ __('Voir les photos de ') . $image->user->name }}">{{ $image->user->name }}</a>
                </em>
                <div class="pull-right">
                    <form class="undo" action="{{ route('admin.undo', $image->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-success my-3">
                            Autoriser
                        </button>
                    </form>
                </div>
                <div class="pull-right">
                @include('partials.delete')
                </div>
            </div>
        </div>
        @endforeach
       
    </div>
</div>
@endsection
