<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PaymentController extends Controller
{
    public function chargeCustomer(Request $req)
    {
        $user = User::find(3); // Example: Fetch the user, replace with dynamic user ID if needed
    
        if ($user) {
            try {
                // Create a payment method ID from the request
                $paymentMethodId = $req->payment_method;
    
                // Ensure the user has a Stripe customer (create one if not)
                $user->createOrGetStripeCustomer();
    
                // Amount to charge (in cents)
                $amount = 1000; // e.g., $10.00 USD
    
                // Charge the user
                $paymentIntent = $user->charge($amount, $paymentMethodId);
    
                // Check payment status (Cashier handles most of this for you)
                if ($paymentIntent->status === 'succeeded') {
                    return response()->json(['message' => 'Payment successful'], 200);
                } elseif ($paymentIntent->status === 'requires_action') {
                    // Payment requires further authentication (e.g., 3D Secure)
                    return response()->json(['message' => 'Payment requires additional authentication'], 400);
                } else {
                    // Payment failed
                    return response()->json(['message' => 'Payment failed'], 400);
                }
    
            } catch (\Stripe\Exception\CardException $e) {
                // Handle card-related errors (e.g., insufficient funds, expired card)
                return response()->json(['error' => $e->getMessage()], 400);
            } catch (\Exception $e) {
                // Handle other exceptions (e.g., API issues)
                return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
