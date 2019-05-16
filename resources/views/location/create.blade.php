@extends('layouts.form')
@section('card')
@component('components.card')
@slot('title')
@lang('Ajouter un lieu')
@endslot
<form method="POST" action="{{ route('location.store') }}">
    {{ csrf_field() }}
    @include('partials.form-group', [
    'title' => __('Lieu'),
    'type' => 'text',
    'name' => 'name',
    'required' => true,
    ])
    @component('components.button')
    @slot('class')
        btn-primary
    @endslot    
        @lang('Soumettre')
    @endcomponent
</form>
@endcomponent
@endsection

@if (session('ok'))
<div class="container mt-5">
    <div class="alert alert-dismissible alert-success fade show" role="alert">
        {{ session('ok') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@yield('content')