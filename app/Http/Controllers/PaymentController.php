<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function showPaymentForm()
    {
        try {
            $payments = Auth::user()->payments()
                          ->latest()
                          ->take(5)
                          ->get();

            return view('payment.form', [
                'payments' => $payments,
                'stripeKey' => config('services.stripe.key')
            ]);

        } catch (\Exception $e) {
            Log::error('Payment form error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load payment form. Please try again.');
        }
    }

    public function processPayment(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:50|max:100000',
        ]);

        try {
            $user = Auth::user();
            $amountInCents = intval($validated['amount'] * 100);

            // Create PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $amountInCents,
                'currency' => 'php',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                ],
            ]);

            // Create payment record
            $payment = Payment::create([
                'user_id' => $user->id,
                'amount' => $validated['amount'],
                'status' => 'pending',
                'stripe_payment_id' => $paymentIntent->id,
                'metadata' => [
                    'client_secret' => $paymentIntent->client_secret
                ]
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'payment_id' => $payment->id
            ]);

        } catch (ApiErrorException $e) {
            Log::error('Stripe payment error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment processing failed'], 500);
        } catch (\Exception $e) {
            Log::error('Payment processing error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment processing failed'], 500);
        }
    }

    public function paymentHistory()
    {
        try {
            $payments = Auth::user()->payments()
                          ->latest()
                          ->paginate(10);

            return view('payment.history', compact('payments'));

        } catch (\Exception $e) {
            Log::error('Payment history error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load payment history.');
        }
    }

    public function refundPayment(Request $request, Payment $payment)
    {
        if ($payment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $refund = \Stripe\Refund::create([
                'payment_intent' => $payment->stripe_payment_id,
                'metadata' => [
                    'refunded_by' => Auth::id(),
                    'reason' => $request->input('reason', 'Customer request')
                ]
            ]);

            $payment->update([
                'status' => 'refunded',
                'refunded_at' => now(),
                'metadata' => array_merge(
                    $payment->metadata ?? [],
                    ['refund_id' => $refund->id]
                )
            ]);

            return back()->with('success', 'Refund processed successfully.');

        } catch (ApiErrorException $e) {
            Log::error('Stripe refund error: ' . $e->getMessage());
            return back()->with('error', 'Refund failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Refund processing error: ' . $e->getMessage());
            return back()->with('error', 'Refund processing failed.');
        }
    }

    public function success()
    {
        try {
            $latestPayment = Auth::user()->payments()
                ->latest()
                ->first();

            if ($latestPayment) {
                // Clear the cart after successful payment
                Cart::where('user_id', Auth::id())->delete();
                
                // Clear session data
                session()->forget(['cart_items', 'customer_info', 'order_total']);

                return view('payment.success', [
                    'payment' => $latestPayment
                ]);
            }

            return redirect()->route('payment.form')
                ->with('error', 'No payment found.');

        } catch (\Exception $e) {
            Log::error('Payment success error: ' . $e->getMessage());
            return redirect()->route('payment.form')
                ->with('error', 'Unable to process payment success.');
        }
    }
} 