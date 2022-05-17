<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    //
    public function bronze(){
        // qui inizializzo braintree
        $gateway = new \Braintree\Gateway([
            // i dati li riprendiamo dal config precedentemente inizializzato
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        // genero il token e lo passo alla rotta, dentro la rotta in var client_token (script) mi riferisco a questo
        $token = $gateway->ClientToken()->generate();
        return view('Admin.Doctors.Subscription.bronze', ['token' => $token]);
    }

    public function checkoutBronze(Request $request){
        $doctor = Auth::user()->doctor;
//        $doctor->subscriptions()->sync([1]);
        $subId = 1;
        $expires = Carbon::tomorrow();
//        $doctor->subscriptions()->attach($subId, ['expires_at' => $expires]);
//        dd($doctor);
        $gateway = new \Braintree\Gateway([
            // i dati li riprendiamo dal config precedentemente inizializzato
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        // questi dati li ricevo da request
        $amount = 2.99;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $doctor->subscriptions()->attach($subId, ['expires_at' => $expires]);
            return redirect('admin.home');
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            $_SESSION["errors"] = $errorString;
//            header("Location: " . $baseUrl . "index.php");
            return redirect('admin.home');
        }
    }
}
