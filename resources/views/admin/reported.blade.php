@extends('layouts.app')
@section('content')
<div class="container">
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
                    <em>
                    <a href="{{ route('admin.undo') }}">undo</a>
                    </em>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection