@extends('layouts.admin')

@section('content')
    <div class="container d-flex flex-wrap justify-content-center">

        @if (session('acquistato'))
            <div class="col-12 mt-5">
                <div class="toast show m-auto">
                    <div class="toast-header d-flex justify-content-between">
                        Pagamento confermato
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        Hai acquistato la sponsorizzazione da {{ session('acquistato') }}€
                    </div>
                </div>
            </div>
        @endif
        @if ($sponsorization)
            <div class="alert alert-success col-12 col-md-6 text-center mt-5" role="alert">
                <h1>Sei sponsorizzato!</h1>
                <p class="text-dark">La tua sponsorizzazione scade il:
                    {{ date('d/m/Y' . ' \a\l\l\e ' . 'H:i', strtotime($sponsorization['pivot_date_end_sponsorization'])) }}
                </p>
            </div>
        @else
            <div class="alert alert-info col-12 col-md-8 text-center mt-5" role="alert">
                <h1>Sponsorizza il tuo profilo</h1>
                <p>scegli uno dei seguenti piani</p>
                <form id="payment-form" action="{{ route('admin.prova') }}" method="get"
                    class="col-8 col-md-12 col-lg-8 col-xl-6 col-xxl-4 text-start m-auto">
                    @csrf
                    @foreach ($sponsorizations as $key => $sponsorization)
                        <label>
                            <input @if ($key == 0) checked @endif type="radio" name="scelta"
                                value="{{ $sponsorization->price }}|{{ $sponsorization->hours }}">
                            {{ $sponsorization->hours }} ore, al costo di {{ $sponsorization->price }} €
                        </label><br>
                    @endforeach
                    <button type="submit" class="btn btn-color col-12 mt-2">Vai al pagamento</button>
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
