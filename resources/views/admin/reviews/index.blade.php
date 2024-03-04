@extends('layouts.admin')

@section('content')
    @if ($reviews)
        <ul>
            @foreach ($reviews as $review)
                <li>{{ $review->review }}</li>
            @endforeach
        </ul>
    @endif
@endsection
