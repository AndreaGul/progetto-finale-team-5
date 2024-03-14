@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="title-color mt-3 title-bold">Recensioni</h1>
        @if ($reviews->count())
            <h6>Numero di recensioni: {{ $reviews->count() }} </h6>
            <ul class="list-unstyled row g-2 ">
                @foreach ($reviews as $review)
                    <li class="col-12 col-lg-6">
                        <div class="card mb-2 ">
                            <div class="card-body">
                                <h5 class="card-title title-color">{{ $review->name_reviewer }}</h5>
                                <p class="card-text">{{ $review->review }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">email: {{ $review->email_reviewer }}</li>
                                <li class="list-group-item">
                                    {{ date('d/m/Y' . ' \a\l\l\e ' . 'H:m', strtotime($review->updated_at)) }}</li>
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info" role="alert">
                Non ci sono recensioni!
            </div>
        @endif
    </div>

@endsection
