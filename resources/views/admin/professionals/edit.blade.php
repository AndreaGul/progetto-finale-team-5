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

    <form class="row g-3 my-3" action=" {{ route('admin.info.update', $user) }}" method="POST" enctype="multipart/form-data"
        id="form">
        @csrf

        @method('PUT')

        <div class="col-12">
            <p class="alert alert-danger mt-3 mb-0 d-none" id='errore-nome'></p>
            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nome" name="name" value="{{ old('name', $user->name) }}"
                required>
        </span>
        <div class="col-12">
            <p class="alert alert-danger mt-3 mb-0 d-none" id='errore-cognome'></p>
            <label for="surname" class="form-label">Cognome <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="cognome" name="surname"
                value="{{ old('surname', $user->surname) }}" required>
        </div>


        <div class="input-group my-4">
            <input type="file" class="form-control" id="curriculum" name="curriculum">
            <label class="input-group-text" for="curriculum">Carica CV</label>

        </div>

        <div class="input-group my-4">
            <input type="file" class="form-control" id="foto" name="photo">
            <label class="input-group-text" for="photo">Carica foto</label>
        </div>


        <div class="col-12">
            <p class="alert alert-danger mt-3 mb-0 d-none" id='errore-telefono'></p>
            <label for="phone" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="telefono" name="phone"
                value="{{ old('phone', $user->professional->phone) }}">
        </div>

        <div class="col-12">
            <p class="alert alert-danger mt-3 mb-0 d-none" id='errore-indirizzo'></p>
            <label for="address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control" id="indirizzo" name="address"
                value="{{ old('address', $user->professional->address) }}">
        </div>


        <div class="col-12">
            <p class="alert alert-danger mt-3 mb-0 d-none" id='errore-descrizione'></p>
            <label for="address" class="form-label">Descrizione</label>
            <div class="form-floating">
                <textarea name="performance" id="descrizione" cols="30" rows="10" class="form-control p-1"
                    placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{ old('address', $user->professional->performance) }}</textarea>
            </div>
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


        <button type="submit" id="submit" class="btn btn-primary col-1">Salva</button>
        </div>
    </form>
    <!-- Js-->
    @vite(['resources/js/validations.js'])
    <!-- Fine Js-->
@endsection
