@extends('layouts.app')
@section('content')

<div class="container mt-5">
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
                @include('partials.delete')
            </div>
          
        </div>
        @endforeach
    </div>
</div>
@endsection