@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="text-primary mt-3">Info</h1>


        <ul class="list-unstyled">

            <li>
                @if (isset($professional->photo) && Storage::exists($professional->photo))
                    <img src="{{ asset('storage/' . $professional->photo) }}" alt="foto profilo assente" class="user-img">
                @elseif(isset($professional->photo))
                    <img src="{{ $professional->photo }}" alt="foto profilo assente" class="user-img">
                @else
                    <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/26530210-moderno-persona-icona-utente-e-anonimo-icona-vettore-vettoriale.jpg"
                        alt="foto profilo assente" class="user-img">
                @endif
            </li>
            <li><span class="text-primary-emphasis fw-bolder">Nome : </span>{{ $user->name }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Cognome : </span> {{ $user->surname }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Email : </span> {{ $user->email }}</li>
            <li>
                @if (isset($professional->curriculum))
                    <a class="text-primary-emphasis fw-bolder" target="_blank"
                        href="{{ asset('storage/' . $professional->curriculum) }}">Curriculum vitae</a>
                @else
                    <span class="text-primary-emphasis fw-bolder">Curriculum: </span>assente
                @endif

            </li>

            <li><span class="text-primary-emphasis fw-bolder">Numero telefono: </span>
                {{ $professional->phone ?: 'Nessun numero di telefono inserito' }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Indirizzo : </span>
                {{ $professional->address ?: 'Nessun indirizzio inserito' }}</li>
            <li><span class="text-primary-emphasis fw-bolder">Descrizione : </span>
                {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>
            <li>
                <span class="text-primary-emphasis fw-bolder">Specializzazioni : </span>
                <ul>
                    @foreach ($professional->specializations as $specialization)
                        <li>{{ $specialization->name }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="text-primary-emphasis fw-bolder">Descrizione : </span>
                {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>

        </ul>

        <a class="btn btn-primary text-light" href="{{ route('admin.info.edit', $user) }}">Modifica</a>
    </div>
@endsection
