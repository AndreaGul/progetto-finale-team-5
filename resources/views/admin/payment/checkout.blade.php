<!-- resources/views/checkout.blade.php -->
<form id="payment-form" action="{{ route('admin.checkout') }}" method="post">
    @csrf

    <div>Prezzo da pagare: {{ $request->input('scelta') }} $</div>
    <input type="hidden" name="price" value="{{ $request->input('scelta') }}">
    <div id="dropin-container"></div>
    <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">
    <button type="submit">Pay</button>
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
