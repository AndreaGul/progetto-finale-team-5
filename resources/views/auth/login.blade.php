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
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
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
            height: 520px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
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

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
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
            margin-top: 50px;
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
    </style>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h3>Login</h3>

        <label for="email">Email</label>
        <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ 'Credenziali errate' }}</strong>
            </span>
        @enderror

        <label for="password">Password</label>
        <input id="password" placeholder="Password" type="password"
            class="form-control @error('password') is-invalid @enderror" name="password" required
            autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ 'Credenziali errate' }}</strong>
            </span>
        @enderror

        <button type="submit">
            {{ __('Login') }}
        </button>
    </form>
@endsection
