@extends('layouts.app')

@section('content')
    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #022B3A;
        }

        .background {
            width: 430px;
            height: 890px;
            position: absolute;
            transform: translate(-50%, -30%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background-color: #BFDBF7;
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background-color:
                #1F7A8C;
            right: -50px;
            bottom: -100px;
        }

        form {
            height: 890px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -30%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        .form-check-inline {
            margin-right: 0;
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 30px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        form>button {
            margin-top: 20px;
            width: 100%;
            background-color: #1F7A8C;
            color: white;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }

        @media (max-width: 767px) {
            .background {
                transform: translate(-50%, -20%);
                z-index: 0;
            }

            form {
                width: 300px;
                transform: translate(-50%, -20%);
            }

            .background .shape {
                height: 100px;
                width: 100px;
            }

            .shape:first-child {
                left: 20px;
                top: -40px;
            }

            .shape:last-child {
                right: 20px;
                bottom: -40px;
            }
        }

        @media ((min-width: 768px) and (max-width: 991px)) {
            .background {
                transform: translate(-50%, -45%);
                z-index: 0;
            }

            form {
                width: 300px;
                transform: translate(-50%, -45%);
            }

            .background .shape {
                height: 100px;
                width: 100px;
            }

            .shape:first-child {
                left: 20px;
                top: -40px;
            }

            .shape:last-child {
                right: 20px;
                bottom: -40px;
            }
        }
    </style>


    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h3>Registrati</h3>

        <label for="name">Nome<span class="text-danger">*</span></label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="surname">Cognome<span class="text-danger">*</span></label>
        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname"
            value="{{ old('surname') }}" required autocomplete="surname" autofocus>

        @error('surname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="address">Indirizzo<span class="text-danger">*</span></label>
        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"
            value="{{ old('address') }}" required autocomplete="address" autofocus>

        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="specializations">Specializzazioni<span class="text-danger">*</span></label>
        <div class="row g-0 mt-2">
            @foreach ($specializations as $specialization)
                <div class="form-check form-check-inline col-6">
                    <input class="form-check-input" type="checkbox" id="spec-{{ $specialization->id }}"
                        name="specializations[]" value="{{ $specialization->id }}"
                        {{ in_array($specialization->id, old('specializations', [])) ? 'checked' : '' }}>
                    <label class="form-check-label mt-0 ms-1"
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

        <label for="email">Email<span class="text-danger">*</span></label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ 'La mail è già in uso' }}</strong>
            </span>
        @enderror

        <label for="password">Password<span class="text-danger">*</span></label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            required autocomplete="new-password">
        <p class="text-danger  d-none" id="error-text"></p>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ 'Le password sono diverse' }}</strong>
            </span>
        @enderror

        <label for="password-confirm">Conferma Password<span class="text-danger">*</span></label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">


        <button type="submit" id="submit">
            Registrati
        </button>
        <p class="mt-3"><span class="text-danger">*</span> Campi obbligatori</p>

    </form>
    <!-- Js-->
    @vite(['resources/js/register.js'])
    <!-- Fine Js-->
@endsection
