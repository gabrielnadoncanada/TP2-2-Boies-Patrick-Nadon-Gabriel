@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Mon profil')
            
            <form class="delete" action="{{ route('user_destroy', $user->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger my-3">
                <i class="fas fa-trash fa-lg"></i>
                </button>
            </form>
            @component('components.modal.button')
                @slot('class')
                    @lang('btn-warning')
                @endslot
                @slot('id')
                                    
                @endslot
                <i class="fas fa-edit fa-lg"></i>
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
                'value' => '',
                'minlength' => 0
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
                'value' => '',
                'minlength' => 0
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
                'minlength' => 6
               
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