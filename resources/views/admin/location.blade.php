@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Liste des lieux') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nom de l'emplacement</th>
                                <th scope="col">Modifier l'emplacement</th>
                                <th scope="col">Supprimer l'emplacement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                            <tr>
                                <th scope="row">{{ $location->name }}</th>
                                <td>
                                    @component('components.modal.button')
                                    @slot('class')
                                    @lang('btn-warning btn-edit-location')
                                    @endslot
                                    @slot('id')
                                    {{ $location->id }}
                                    @endslot
                                    <i class="fas fa-edit fa-lg"></i>
                                    @endcomponent
                                </td>
                                <td><a href="{{ route('location_destroy', $location->id) }}" class="delete ml-auto btn btn-danger btn-sm" role="button" aria-disabled="true" data-toggle="tooltip" title="@lang('Supprimer cette emplacement')"> <i class="fas fa-trash fa-lg"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@component('components.modal.modal')
@slot('title')
@lang('Modifier le lieux')
@endslot
@slot('content')
<form method="POST" id="myform" data-pepto="1" action="{{ route('location.update', $location->id) }}">
    @csrf
    @method('PUT')
    @include('partials.form-group', [
    'title' => __('Nouveau nom de lieux'),
    'type' => 'text',
    'name' => 'name',
    'required' => false,
    'minlength' => 0
    ])
    @component('components.button')
    @slot('class')
    @lang('btn-primary')
    @endslot
    @lang('Envoyer')
    @endcomponent
</form>
@endslot
@endcomponent
@endsection
