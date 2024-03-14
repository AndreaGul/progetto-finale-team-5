@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }} <span
                                        class="text-danger">*</span></label>


                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}
                                    <span class="text-danger">*</span></label>


                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}
                                    <span class="text-danger">*</span></label>


                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="specializations"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Specializzazioni') }}
                                    <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    @foreach ($specializations as $specialization)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                id="spec-{{ $specialization->id }}" name="specializations[]"
                                                value="{{ $specialization->id }}"
                                                {{ in_array($specialization->id, old('specializations', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="tech-{{ $specialization->id }}">{{ $specialization->name }}</label>
                                        </div>
                                    @endforeach

                                    <p class="text-danger d-none" id="error-specializations"></p>
                                    @error('specializations')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}
                                    <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'La mail è già in uso' }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}
                                    <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    <p class="text-danger  d-none" id="error-text"></p>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'Le password sono diverse' }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }} <span
                                        class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="submit">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p class="mt-3"><span class="text-danger">*</span> Campi obbligatori</p>
                        <!-- Js-->
                        @vite(['resources/js/register.js'])
                        <!-- Fine Js-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
