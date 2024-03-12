@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-primary mt-3 text-center">Sponsorizzazioni</h1>
        <!-- resources/views/checkout.blade.php -->
        <form id="payment-form" action="{{ route('admin.checkout') }}" method="post">
            @csrf
            <input type="hidden" name="price" value="{{ $request->input('scelta') }}">
            <div id="dropin-container"></div>
            <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">
            <div class="d-flex flex-wrap justify-content-end">
                <h3 class="text-success text-end col-12">{{ $request->input('scelta') }} $</h3>
                <button type="submit" class="btn btn-primary col-1">Paga</button>
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
