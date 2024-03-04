@extends('layouts.admin')

@section('content')



    <div class="my-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <div class="alert alert-warning d-none" id="error-fe" role="alert">
        Campi non validi:
        <p id="error-text"></p>
    </div>

    <form class="row g-3 my-3" action=" {{ route('admin.info.update', $user) }}" method="POST" enctype="multipart/form-data"
        id="form">
        @csrf
        @method('PUT')

        <div class="col-12">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                required>
        </div>
        <div class="col-12">
            <label for="surname" class="form-label">Cognome</label>
            <input type="text" class="form-control" id="surname" name="surname"
                value="{{ old('surname', $user->surname) }}" required>
        </div>
        <div class="col-12">
            <div>
                <label for="specializations" class="form-label">Specializzazioni:</label>
            </div>
            @foreach ($specializations as $specialization)
                <div class="form-check form-check-inline">
                    @if ($errors->any())
                        <input class="form-check-input" type="checkbox" id="spec-{{ $specialization->id }}"
                            name="specializations[]" value="{{ $specialization->id }}"
                            {{ in_array($specialization->id, old('specializations', [])) ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="tech-{{ $specialization->id }}">{{ $specialization->name }}</label>
                    @else
                        <input class="form-check-input" type="checkbox" id="spec-{{ $specialization->id }}"
                            name="specializations[]" value="{{ $specialization->id }}"
                            {{ $professional->specializations->contains($specialization->id) ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="tech-{{ $specialization->id }}">{{ $specialization->name }}</label>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="input-group my-4">
            <input type="file" class="form-control" id="curriculum" name="curriculum">
            <label class="input-group-text" for="curriculum">Carica CV</label>
        </div>
        <div class="input-group my-4">
            <input type="file" class="form-control" id="photo" name="photo">
            <label class="input-group-text" for="photo">Carica foto</label>
        </div>
        <div class="col-12">
            <label for="phone" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="phone" name="phone"
                value="{{ old('phone', $user->professional->phone) }}">
        </div>
        <div class="col-12">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control" id="address" name="address"
                value="{{ old('address', $user->professional->address) }}">
        </div>
        <div class="col-12">
            <label for="performance" class="form-label">Descrizione</label>
            <div class="form-floating">
                <textarea name="performance" id="performance" cols="30" rows="10" class="form-control p-1"
                    placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">
                    {{ old('performance', $user->professional->performance) }}
                </textarea>
            </div>
        </div>
        <button type="submit" id="submit" class="btn btn-primary col-1">Modifica</button>
        </div>
    </form>
    <!-- Js-->
    @vite(['resources/js/validations.js'])
    <!-- Fine Js-->
@endsection
