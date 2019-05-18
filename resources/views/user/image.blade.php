@extends('layouts.app')
@section('content')

<div class="container mt-5">
    
    @if($images->count() === 0)
        <div class="row justify-content-center">
            <div class="col-md-8">
                @component('components.card')
                    @slot('title')
                        @lang('Vous avez aucune images pour le moment')
                    @endslot
                    <a href="{{ route('image.create')}}" class="ml-auto btn btn-primary btn-sm" role="button" aria-disabled="true">@lang('Ajouter une image')</a>
                @endcomponent
            </div>    
        </div> 
    @else
    <div class="card-columns">

        @foreach($images as $image)
        <div class="card" id="image{{ $image->id }}">
            <img class="card-img-top" src="{{ url('thumbs/' . $image->name) }}" alt="image">
            <div class="card-footer text-muted">
                <div>
                    <h4 class="mb-3">{{ $image->location->name }}</h4>
                </div>
                <em>
                    <a href="#" data-toggle="tooltip" title="{{ __('Voir les photos de ') . $image->user->name }}">{{ $image->user->name }}</a>
                </em>
                <div class="pull-right">
                    <em>
                        {{ $image->created_at->formatLocalized('%x') }}
                    </em>
                </div>
                @if ($image->user_id === Auth::user()->id or Auth::user()->role == "admin")
                @include('partials.delete')
                @endif
            </div>

        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection