@extends('layouts.form')

@endsection
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Modifer le profil')
            <a href="{{ route('profile.destroy', $user->id) }}" class="btn btn-danger btn-sm pull-right invisible" role="button" aria-disabled="true"><i class="fas fa-angry fa-lg"></i> @lang('Supprimer mon compte')</a>
        @endslot
        <form method="POST" action="{{ route('profile.update', $user->id) }}">
            @csrf
            @method('PUT')
            @include('partials.form-group', [
                'title' => __('Adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => true,
                'value' => $user->email,
            ])
          
            @component('components.button')
                @lang('Envoyer')
            @endcomponent
        </form>
    @endcomponent
@endsection

    @include('partials.script-delete', ['text' => __('Vraiment supprimer votre compte ?'), 'return' => 'home'])
@endsection