@extends('layouts.admin')

@section('content')
    @if ($messages)
        <ul>
            @foreach ($messages as $message)
                <li>{{ $message->message }}</li>
            @endforeach
        </ul>
    @else
        <div>non ci sono messaggi</div>
    @endif
@endsection
