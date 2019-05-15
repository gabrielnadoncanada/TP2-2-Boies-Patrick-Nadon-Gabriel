@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Mon profil')
            
            <a href="{{ route('user_destroy', $user->id) }}" class="delete ml-auto btn btn-danger btn-sm" role="button" aria-disabled="true"> @lang('Supprimer mon compte')</a>
            @component('components.modal.button')
                @slot('class')
                    @lang('btn-warning')
                @endslot
                @lang('Modifier')
            @endcomponent
        @endslot
        <label for="email">Adresse email</label> 
        <input id="email" type="email" class="text-white form-control-plaintext{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" readonly>
        <br>
        <label for="nane">Nom d'utilisateur</label> 
        <input id="name" type="text" class="text-white form-control-plaintext{{ $errors->has('name') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->name }}" readonly>
    @endcomponent
@endsection

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
                'required' => false,
                'value' => $user->email,
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
                'required' => false,
                'value' => $user->name,
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
                'required' => false,
               
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
    $('#modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>
@endsection