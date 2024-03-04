@extends('layouts.admin')

@section('content')
    <h1 class="text-primary mt-3">Reviews</h1>
    @if ($reviews->count())
        <ul class="list-unstyled">
            @foreach ($reviews as $review)
                <li class="mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"> {{ $review->name_reviewer }}</h3>
                            <h5> {{ $review->email_reviewer }}</h5>
                            {{ $review->review }}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info" role="alert">
            Non ci sono recensioni!
        </div>
    @endif
@endsection
