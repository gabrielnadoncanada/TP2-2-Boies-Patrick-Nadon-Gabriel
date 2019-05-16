@extends('layouts.form')
@section('card')
@component('components.card')
@slot('title')
@lang('Ajouter une image')
@endslot

<form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
        <div class="custom-file">
            <input type="file" id="image" name="image" class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input" required>
            <label class="custom-file-label" for="image"></label>
            @if ($errors->has('image'))
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            @endif
        </div>
        <br>
    </div>
    <div class="form-group">
        <img id="preview" class="img-fluid" src="#" alt="">
    </div>
    <div class="form-group">
        <label for="locations">@lang('Lieu')</label>
        <select id="locations" name="location_id" class="form-control">
            @foreach($locations as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
        <!--  -->
    </div>
    @component('components.button')
    @slot('class')
        btn-primary
    @endslot    
        @lang('Soumettre')
    @endcomponent
</form>
@endcomponent
@endsection
@section('script')
<script>
    $(() => {
        $('input[type="file"]').on('change', (e) => {
            let that = e.currentTarget
            if (that.files && that.files[0]) {
                $(that).next('.custom-file-label').html(that.files[0].name)
                let reader = new FileReader()
                reader.onload = (e) => {
                    $('#preview').attr('src', e.target.result)
                }
                reader.readAsDataURL(that.files[0])
            }
        })
    })
</script>
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