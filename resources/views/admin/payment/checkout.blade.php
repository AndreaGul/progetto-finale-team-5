@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="title-color mt-3 col-12 title-bold text-center">Pagamento</h1>
        <h6 class="alert alert-info mt-3 text-left m-auto col-6">Hai scelto la sponsorizzazione da <strong>{{ explode('|', $request->input('scelta'), 2)[0] }}€</strong> di <strong>{{ explode('|', $request->input('scelta'), 2)[1] }} ore</strong>, con scadenza il {{ date("d/m/Y \a\l\l\\e H:i", strtotime(now() . '+ ' . explode('|', $request->input('scelta'), 2)[1] . ' hours')) }}</h6>
        <!-- resources/views/checkout.blade.php -->
        <form id="payment-form" action="{{ route('admin.checkout') }}" method="post">
            @csrf
            <input type="hidden" name="price" value="{{ explode('|', $request->input('scelta'), 2)[0] }}">
            <div id="dropin-container"></div>
            <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">
            <div class="d-flex flex-wrap justify-content-end">
                <h3 class="text-success text-end col-12">{{ explode('|', $request->input('scelta'), 2)[0] }} €</h3>
                <button type="submit" class="btn btn-primary col-3 col-lg-1">Paga</button>
            </div>
        </form>

        <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
        <script>
            var form = document.querySelector('#payment-form');
            var client_token = "{{ $clientToken }}";

            braintree.dropin.create({
                authorization: client_token,
                container: '#dropin-container'
            }, function(createErr, instance) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    instance.requestPaymentMethod(function(err, payload) {
                        if (err) {
                            console.log('Error', err);
                            return;
                        }

                        // Include il nonce di pagamento nel modulo e invia la richiesta POST
                        document.querySelector('#payment_method_nonce').value = payload.nonce;
                        form.submit();
                    });
                });
            });
        </script>
    </div>
@endsection
