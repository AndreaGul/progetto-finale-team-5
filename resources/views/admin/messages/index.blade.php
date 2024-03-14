@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-primary mt-3 text-center">Messaggi</h1>
    @if ($messages->count())
        <h3>Numero di messaggi: {{$messages->count()}} </h3>
        <ul class="list-unstyled">
            @foreach ($messages as $message)
                <li class="mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"> {{ $message->name }}</h3>
                            <span>{{  date("d/m/Y". ' \a\l\l\e ' ."H:m", strtotime($message->updated_at)) }}</span>
                            <h5> {{ $message->sender_email }}</h5>
                            {{ $message->message }}
                        </div>
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
