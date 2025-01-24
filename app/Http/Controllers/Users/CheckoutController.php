<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Illuminate\Support\Str;
use Stripe\Webhook;

class CheckoutController extends Controller
{
    public function checkout(Request $request){

        $test = Transaction::find(4);
        dd($test->order);
        $document_id = $request->id;
        $document = Document::find($document_id);
        $title = $document->title;
        $price = $document->doc_price;
        // $customer_id=getOrCreateCustomer();
        $user=auth()->user();
        $payment_des="Payment for the Document ID : $document->id of Rupeers $price";
        $intent = PaymentIntent::create([
            'currency' => 'usd',
            'amount' => ($price * 100 ), 
            'payment_method_types' => ['card'],
            'description' => $payment_des,
            'shipping' => [
                'name' => $user->first_name,
                'address' => [
                    'line1' =>  'Address not provided',
                    'city' => 'City not provided',
                    'state' =>'State not provided',
                    'postal_code' => 'Postal code not provided',
                    'country' => 'IN',    
                ],
            ],
        ]);
        $clientSecret= $intent->client_secret ; 
        return view('users.checkout.checkout',compact('title','price','intent', 'clientSecret','document'));
    }



    public function order_confirm(Request $request){

        $request->validate([
            'payment_method' => 'required|string',
            'payment_intent' => 'required|string',
        ]);
    
        $paymentMethodId = $request->input('payment_method');
        $paymentIntentId = $request->input('payment_intent');

        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            if ($paymentIntent->status === 'succeeded') {
               
               return view('users.checkout.order_confirmation');
            } else {
                
                return response()->json([
                    'success' => false,
                    'message' => 'Payment is not yet complete. Further action may be required.',
                
                ]);
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., invalid PaymentIntent, expired payment method, etc.)
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return view('users.checkout.order_confirmation');
    }


    public function placeOrder( Request $request ){

        try{
            $order = new Order ;
            $orderNum = "MX_" . uniqid() . strtoupper(Str::random(5)); 
            $order->document_id = $request->document_id; 
            $order->quantity = 0; 
            $order->order_num = $orderNum; 
            $order->user_id = auth()->user()->id ; 
            $order->price = ($request->price/100); 
            $order->discount_amount = 0;
            $order->total_price = ($order->price - $order->discount_amount) ; 
            $order->status = 0;
            $order->save();
            // Create the transaction in the Database with the status of the Pending 
            $trans = new Transaction ;
            $trans->order_id = $order->id; 
            $trans->payment_intent = $request->payment_intent ?? ""; 
            $trans->payment_intent = 0 ;
            $trans->save();
            return response()->json([
                'success' => true,
                'data' => $request->all(), 
            ]);

        }catch(\Exception $e ){
            
        }


    } 
}
