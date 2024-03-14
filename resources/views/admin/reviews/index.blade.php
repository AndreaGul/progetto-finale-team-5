@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-primary mt-3 text-center">Recensioni</h1>
    @if ($reviews->count())
     <h3>Numero di recensioni: {{$reviews->count()}} </h3>
        <ul class="list-unstyled">
            @foreach ($reviews as $review)
                <li class="mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"> {{ $review->name_reviewer }}</h3>
                            <span>{{  date("d/m/Y". ' \a\l\l\e ' ."H:m", strtotime($review->updated_at)) }}</span>
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
</div>
@endsection
