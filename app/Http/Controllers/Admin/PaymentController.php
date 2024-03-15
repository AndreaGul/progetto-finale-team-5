<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Models\Sponsorization;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $request->input('price'),
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $professional = Professional::where('user_id', Auth::id())->first();
            $sponsorization = Sponsorization::where('price', $request->input('price'))->first();
            $prova = date("Y-m-d H:i:s", strtotime(now() . '+ ' . $sponsorization->hours . ' hours'));
            $professional->sponsorizations()->attach($sponsorization->id, ['date_end_sponsorization' => $prova]);

            return redirect()->route('admin.sponsorization')->with('acquistato', $request->input('price'));
        } else {
            return 'Errore durante il pagamento: ' . $result->message;
        }
    }
}
