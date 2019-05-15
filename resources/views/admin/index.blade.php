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
                                <td>0</td>
                                <td><button type="sumbit">Modifier</button></td>
                                <td><button type="sumbit">Delete</button></td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection