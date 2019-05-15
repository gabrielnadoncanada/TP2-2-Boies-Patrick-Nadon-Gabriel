@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Mon profil')
            
            <a href="{{ route('user_destroy', $user->id) }}" class="delete ml-auto btn btn-danger btn-sm" role="button" aria-disabled="true"> @lang('Supprimer mon compte')</a>
        @endslot
        <label for="email">Adresse email</label> 
        <input id="email" type="email" class="text-white form-control-plaintext{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" readonly>
        <br>
        <label for="nane">Nom d'utilisateur</label> 
        <input id="name" type="text" class="text-white form-control-plaintext{{ $errors->has('name') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->name }}" readonly>
    @endcomponent

    @component('components.card')
        @slot('title')
            @lang('Modifer le profil')
            <a href="{{ route('user.destroy', $user->id) }}" class="btn btn-danger btn-sm pull-right invisible" role="button" aria-disabled="true"><i class="fas fa-angry fa-lg"></i> @lang('Supprimer mon compte')</a>
        @endslot
        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            @include('partials.form-group', [
                'title' => __('Nouvelle adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => false,
                'value' => $user->email,
            ])
          
            @component('components.button')
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
                'required' => false,
                'value' => $user->name,
            ])
          
            @component('components.button')
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
                'required' => false,
               
            ])
          
            @component('components.button')
                @lang('Envoyer')
            @endcomponent
        </form>
    @endcomponent
@endsection

@section('script')
    <script>
     $('.delete').submit((e) => {
        e.preventDefault();
        let href = $(e.currentTarget).attr('action')
        if (confirm('Voulez-vous vraiment suprimer?')){
            $.ajax({
                url: href,
                type: 'GET'
            })
            .done((data) => {
                alert(data.message)
            })
            .fail((data) => {
                alert("Échec du signalement de la supression de l'image")
            })
        }
 
    })

</script>
@endsection