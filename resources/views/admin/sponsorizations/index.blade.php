@extends('layouts.admin')

@section('content')
    <div class="container">

        @if ($sponsorization)
            <h1>Sei sponsorizzato!</h1>
            <p>La tua sponsorizzazione scade il: {{ $sponsorization['pivot_date_end_sponsorization'] }}</p>
        @else
            <h1>Non sei sponsorizzato, scegli uno dei seguenti piani</h1>


            {{-- @foreach ($sponsorizations as $sponsorization)
                <label>
                    <input type="radio" name="scelta" value="{{ $sponsorization->id }}">
                    {{ $sponsorization->hours }} ore, al costo di {{ $sponsorization->price }}$
                </label><br>
            @endforeach --}}

            <form id="payment-form" action="{{ route('admin.prova') }}" method="get">
                @csrf
                @foreach ($sponsorizations as $key => $sponsorization)
                    <label>
                        <input @if ($key == 0) checked @endif type="radio" name="scelta"
                            value="{{ $sponsorization->price }}">
                        {{ $sponsorization->hours }} ore, al costo di {{ $sponsorization->price }}$
                    </label><br>
                @endforeach
                <button type="submit" class="btn btn-primary">vai al pagamento</button>
            </form>
        @endif
    </div>
@endsection
