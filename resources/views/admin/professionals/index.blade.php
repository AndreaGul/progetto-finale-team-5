@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="text-primary mt-3">Info</h1>


        <ul class="list-unstyled">
            <li><span class="text-primary-emphasis fw-bolder">Nome : </span>{{ $user->name }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Cognome : </span> {{ $user->surname }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Email : </span> {{ $user->email }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Curriculum : </span>
                {{ $professional->curriculum ?: 'Nessun curriculum inserito' }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Foto : </span>
                {{ $professional->photo ?: 'Nessuna foto inserita' }}</li>
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
