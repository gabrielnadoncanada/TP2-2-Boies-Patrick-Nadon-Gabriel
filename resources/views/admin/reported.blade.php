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
                    <form class="delete" action="{{ route('admin.undo', $image->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger my-3">
                            undo
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
