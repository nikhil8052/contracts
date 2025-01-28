<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use Stripe\Webhook;

class WebhookController extends Controller
{
    public function handleStripeWebhook(Request $request)
    {
    
        $endpointSecret = web_setting('STRIPE_WEBHOOK_SECRET', true);
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
                $intent_id = $paymentIntent->id;
                $transaction = Transaction::where('payment_intent', $intent_id)->first();
                if ($transaction) {
                    $order = $transaction->order;
                    if ($order) {
                        $transaction->amount = $order->amount;
                        $transaction->type = 'stripe';
                        $transaction->status = 'succeeded';
                        $order->status = 1;
                        $order->save();
                        $transaction->save();
                    } else {
                        \Log::error('Order not found for transaction with intent ID: ' . $intent_id);
                    }
                } else {
                    
                }

                break;
            case 'payment_intent.payment_failed':
           
                $paymentIntent = $event->data->object;
                $intent_id = $paymentIntent->id;
                $transaction = Transaction::where('payment_intent', $intent_id)->first();
                if ($transaction) {
                    $order = $transaction->order;
                    if ($order) {
                        $transaction->amount = $order->amount;
                        $transaction->type = 'stripe';
                        $transaction->status = 'payment_failed';
                        $transaction->save();
                    } else {
                        \Log::error('Order not found for transaction with intent ID: ' . $intent_id);
                    }
                } else {
                    
                }

                break;

            case 'payment_intent.processing':
                $paymentIntent = $event->data->object;
                \Log::info('Payment processing: ' . $paymentIntent->id);
                // Handle processing payment
                break;
            
            case 'charge.refunded':
                $charge = $event->data->object;
                $intent_id = $charge->payment_intent;
                $transaction = Transaction::where('payment_intent', $intent_id)->first();
                if ($transaction) {
                    $order = $transaction->order;
                    if ($order) {
                        $transaction->status = 'refunded';
                        $order->status = 2;
                        $order->save();
                        $transaction->save();

                    } else {
                    }
                }

                break ;
            
            default:
                \Log::warning('Unhandled event type: ' . $event->type);
        }

        return response()->json(['status' => 'success']);
    }


    public function handlePaypalWebhook(){

        $payload = $request->all();
        saveLog('paypal', 'test ');
        saveLog('paypal', 'test ', $payload);

        if (isset($payload['event_type'])) {
            switch ($payload['event_type']) {
                case 'PAYMENT.CAPTURE.COMPLETED':
                    $paypalOrderId = $payload['resource']['id']; // PayPal Order ID
                    $status = $payload['resource']['status'];    // Payment status

                    // Find and update the corresponding order in your database
                    $order = Order::where('paypal_order_id', $paypalOrderId)->first();
                    if ($order) {
                        $order->update([
                            'status' => 1,
                        ]);
                    }
                    break;

                case 'PAYMENT.CAPTURE.DENIED':
                    // Handle denied payments
                    break;

                default:
                    // Handle other event types
                    break;
            }
        }

     
    }
}
