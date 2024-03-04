@extends('layouts.admin')

@section('content')
    @if ($reviews->count())
        <ul>
            @foreach ($reviews as $review)
                <li>{{ $review->review }}</li>
            @endforeach
        </ul>
    @else
        <div>non ci sono recensioni</div>
    @endif
@endsection
