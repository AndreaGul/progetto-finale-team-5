@extends('layouts.admin')

@section('content')
    <div class="container d-flex flex-wrap justify-content-center">

        <h1 class="mt-3 text-primary col-12 text-center">Sponsorizzazioni</h1>
        @if(!session('acquistato'))
        <div class="col-12">
            <div class="toast show m-auto">
                <div class="toast-header d-flex justify-content-between">
                    Conferma Pagamento
                  <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">    
                  Hai acquistato una sponsorizzazione
                </div>
            </div>
        </div>
        @endif
        @if ($sponsorization)
        <div class="alert alert-success col-6 text-center mt-5" role="alert">
           <h3>Sei sponsorizzato!</h3>
           <p class="text-dark">La tua sponsorizzazione scade il: {{ date("d/m/Y". ' \a\l\l\e ' . "H:i", strtotime($sponsorization['pivot_date_end_sponsorization'])) }}</p>
        </div>
        @else
        <div class="alert alert-info col-6 text-center mt-5" role="alert">
            <h3>Non sei sponsorizzato</h3>
            <p>scegli uno dei seguenti piani</p>
            <form id="payment-form" action="{{ route('admin.prova') }}" method="get" class="col-4 text-start m-auto">
                @csrf
                @foreach ($sponsorizations as $key => $sponsorization)
                    <label>
                        <input @if ($key == 0) checked @endif type="radio" name="scelta"
                            value="{{ $sponsorization->price }}">
                        {{ $sponsorization->hours }} ore, al costo di {{ $sponsorization->price }} €
                    </label><br>
                @endforeach
                <button type="submit" class="btn btn-primary col-12 mt-2">vai al pagamento</button>
            </form>
         </div>


            {{-- @foreach ($sponsorizations as $sponsorization)
                <label>
                    <input type="radio" name="scelta" value="{{ $sponsorization->id }}">
                    {{ $sponsorization->hours }} ore, al costo di {{ $sponsorization->price }}$
                </label><br>
            @endforeach --}}

        @endif
    </div>
@endsection
