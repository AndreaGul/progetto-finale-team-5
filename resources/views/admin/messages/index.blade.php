@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="title-color mt-3 title-bold">Messaggi</h1>
        @if ($messages->count())
            <h6>Numero di messaggi: {{ $messages->count() }} </h6>
            <ul class="list-unstyled row g-2 ">
                @foreach ($messages as $message)
                    <li class="col-12 col-lg-6">
                        <div class="card mb-2 ">
                            <div class="card-body">
                                <h5 class="card-title title-color">{{ $message->name }}</h5>
                                <p class="card-text">{{ $message->message }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">email: {{ $message->sender_email }}</li>
                                <li class="list-group-item">
                                    {{ date('d/m/Y' . ' \a\l\l\e ' . 'H:m', strtotime($message->updated_at)) }}</li>
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info" role="alert">
                Non ci sono messaggi!
            </div>
        @endif
    </div>

@endsection
