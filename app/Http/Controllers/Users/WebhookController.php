<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction ;
use App\Models\Order ;
use Stripe\Webhook;

class WebhookController extends Controller
{
    
    public function handleWebhook(Request $request)
    {
        $endpointSecret =  web_setting('STRIPE_WEBHOOK_SECRET', true );
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $event = null;
        try {
            // Verify the webhook signature
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $intent_id =  $paymentIntent->id ; 
                $trans = Transaction::where('payment_intent', $intent_id)->first();
                if( $trans ){
                    $order= $trans->order ; 
                    $trans->amount= $order->amount; 
                    $trans->type= 'stripe'; 
                    $trans->status= 1; 
                    $order->status=1;
                    $order->save();
                    $trans->save();
                }else {
                    // update the status in the db that status not found 
                }
             
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                \Log::error('Payment failed: ' . $paymentIntent->id);
                // Handle failed payment
                break;

            case 'payment_intent.processing':
                $paymentIntent = $event->data->object;
                \Log::info('Payment processing: ' . $paymentIntent->id);
                // Handle processing payment
                break;

            default:
                \Log::warning('Unhandled event type: ' . $event->type);
        }

        return response()->json(['status' => 'success']);
    }
    
}
