<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    //index
    public function index($slug){
        if(Auth::user()->doctor->slug == $slug){
            $bronze = Subscription::whereId(1)->first();
            $silver = Subscription::whereId(2)->first();
            $gold = Subscription::whereId(3)->first();
            return view('Admin.Subscription.homesubscription', compact('bronze', 'silver', 'gold'));
        } else{
            return redirect()->route('401');
        }
    }
    public function token($type){
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
        $subscription = Subscription::where('name', $type)->first();
        return view('Admin.Subscription.braintree', ['token' => $token, 'type' => $subscription]);
    }

    public function checkout(Request $request, $price){
        $doctor = Auth::user()->doctor;
//        $doctor->subscriptions()->sync([1]);
        $subscription = Subscription::wherePrice($price)->first();
        $subId = $subscription->id;
        if($price == 2.99){
            $expires = Carbon::tomorrow();
        } elseif($price == 5.99){
            $expires = Carbon::tomorrow()->addDays(2);
        } else {
            $expires = Carbon::tomorrow()->addDays(5);
        }
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
        $amount = $price;
        $nonce = $request->payment_method_nonce;
//        dd($nonce);
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $doctor->subscriptions()->attach($subId, ['expires_at' => $expires]);
            return view('Admin.Subscription.checkout', compact('subscription', 'expires'));
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            $_SESSION["errors"] = $errorString;
//            header("Location: " . $baseUrl . "index.php");
            return view('Admin.Subscription.errorCheckout', compact('subscription', 'errorString'));
        }
    }

}
