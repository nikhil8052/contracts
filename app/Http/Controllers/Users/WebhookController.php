<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use Stripe\Webhook;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
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
}
