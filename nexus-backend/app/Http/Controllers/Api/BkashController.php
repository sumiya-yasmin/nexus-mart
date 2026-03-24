<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BkashController extends Controller
{
    public function getToken()
    {
        $response = Http::withHeaders([
            'username' => env('BKASH_CHECKOUT_URL_USER'),
            'password' => env('BKASH_CHECKOUT_URL_PASSWORD'),
        ])->post(env('BKASH_BASE_URL') . '/checkout/token/grant', [
            'app_key' => env('BKASH_CHECKOUT_URL_APP_KEY'),
            'app_secret' => env('BKASH_CHECKOUT_URL_APP_SECRET'),
        ]);
        return $response->json();
    }
    //create-payment
    public function createPayment(Request $request)
    {
        $tokenData = $this->getToken();
        if (!isset($tokenData['id_token'])) {
            return response()->json(['message' => 'bKash Authentication Failed', 'details' => $tokenData], 500);
        }
        $idToken = $tokenData['id_token'];

        $response = Http::withHeaders([
            'Authorization' => $idToken,
            'X-APP-Key' => env('BKASH_CHECKOUT_URL_APP_KEY'),
            'Content-Type' => 'application/json'
        ])->post(env('BKASH_BASE_URL') . '/checkout/create', [
            'mode' => '0011',
        'payerReference' => 'NexusMart_Order', 
            'amount' => (string)$request->amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => 'INV' . time(),
            'callbackURL' => 'http://localhost/api/bkash/callback',
        ]);

        return $response->json();
    }
    //callback
    public function callBack(Request $request)
{
    if ($request->status !== 'success') {
        return redirect('http://localhost:5173/cart?payment=failed');
    }

    $tokenData = $this->getToken();
    $idToken = $tokenData['id_token'];

    $response = Http::withHeaders([
        'Authorization' => $idToken,
        'X-APP-Key' => env('BKASH_CHECKOUT_URL_APP_KEY'),
        'Content-Type' => 'application/json'
    ])->post(env('BKASH_BASE_URL') . '/checkout/execute', [
        'paymentID' => $request->paymentID
    ]);

    $result = $response->json();

    if (isset($result['transactionStatus']) && $result['transactionStatus'] === 'Completed') {

        
        return redirect('http://localhost:5173/payment/success?amount=' . $result['amount'] . '&method=bkash');
    }

    return redirect('http://localhost:5173/cart?error=execution_failed');
}
}
