@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="text-primary mt-3">Info</h1>


        <ul class="list-unstyled">

            <li><span class="text-primary-emphasis fw-bolder">Nome : </span>{{ $user->name }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Cognome : </span> {{ $user->surname }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Email : </span> {{ $user->email }}</li>
            <li>
                @if ( isset($professional->curriculum))
                    <a class="text-primary-emphasis fw-bolder" target="_blank" href="{{ asset('storage/'. $professional->curriculum ) }}">Curriculum vitae</a>
                @else
                    <p>Curriculum assente</p>
                @endif
            
            </li>
            
            <li><img src="{{ asset('storage/'. $professional->photo ) }}" alt="foto assente">
            </li>
            <li><span class="text-primary-emphasis fw-bolder">Numero telefono: </span>
                {{ $professional->phone ?: 'Nessun numero di telefono inserito' }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Indirizzo : </span>
                {{ $professional->address ?: 'Nessun indirizzio inserito' }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Descrizione : </span>
                {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>

        </ul>

        <a class="btn btn-primary text-light" href="{{ route('admin.info.edit', $user) }}">Modifica</a>
    </div>
@endsection
