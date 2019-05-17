@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Liste utilisateurs') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nom d'utilisateur</th>
                                <th scope="col">Courriel</th>
                                <th scope="col">Date d'inscription</th>
                                <th scope="col">Date de vérification</th>
                                <th scope="col">Nombre d'images en ligne</th>
                                <th scope="col">Modifier le compte</th>
                                <th scope="col">Supprimer le compte</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->email_verified_at }}</td>
                                <td>{{ $user->images_count }}</td>
                                <td>
                                @component('components.modal.button')
                                    @slot('class')
                                        @lang('btn-warning btn-edit')
                                    @endslot
                                    @slot('id')
                                        {{ $user->id }}
                                    @endslot
                                    @lang('Modifier')
                                @endcomponent
                                </td>
                                <td><a href="{{ route('user_destroy', $user->id) }}" class="delete ml-auto btn btn-danger btn-sm" role="button" aria-disabled="true">@lang('Supprimer')</a></td>
                                
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
        @lang('Modifier le profil')
    @endslot
    @slot('content')
        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            @include('partials.form-group', [
                'title' => __('Nouvelle adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => false
            ])
          
            @component('components.button')
                @slot('class')
                    @lang('btn-primary')
                @endslot
                @lang('Envoyer')
            @endcomponent
        </form>
        <br>
        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            @include('partials.form-group', [
                'title' => __('Nouveau nom utilisateur'),
                'type' => 'text',
                'name' => 'name',
                'required' => false
            ])
          
            @component('components.button')
                @slot('class')
                    @lang('btn-primary')
                @endslot
                @lang('Envoyer')
            @endcomponent
        </form>
        <br>
        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            @include('partials.form-group', [
                'title' => __('Nouveau mot de pass'),
                'type' => 'password',
                'name' => 'password',
                'required' => false
               
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
@section('script')
<script>
    $('.btn-edit').on('click', function() {
        var button = $(event.relatedTarget) 
        var recipient = $(this).data('id') 
        
        var path = "/../../users/";
        
        
        $('form').attr('action', path + recipient)
    })
    
</script>
@endsection