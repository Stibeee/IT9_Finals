<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Coffee Shop</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #000000;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #ffffff;
            padding: 24px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #2196F3);
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 14px;
            color: #666666;
        }

        .content {
            padding: 32px;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #f8f8f8;
            color: #000000;
            border: 1px solid #e0e0e0;
        }

        .alert-danger {
            background-color: #f8f8f8;
            color: #000000;
            border: 1px solid #e0e0e0;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #000000;
            font-weight: 500;
            font-size: 14px;
        }

        .amount-input {
            position: relative;
        }

        .amount-input span {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666666;
            font-weight: 500;
        }

        input[type="number"] {
            width: 100%;
            padding: 12px 12px 12px 32px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        input[type="number"]:focus {
            border-color: #000000;
            outline: none;
        }

        #card-element {
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background: white;
            transition: all 0.2s ease;
        }

        #card-element:focus-within {
            border-color: #000000;
        }

        .error {
            color: #000000;
            margin-top: 8px;
            font-size: 13px;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #000000;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        button:hover {
            background: #333333;
        }

        button:disabled {
            background: #e0e0e0;
            cursor: not-allowed;
        }

        #response {
            margin-top: 20px;
            padding: 12px;
            border-radius: 6px;
            background-color: #f8f8f8;
            color: #000000;
            font-size: 14px;
            display: none;
        }

        .order-summary {
            background: #f8f8f8;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .order-summary h3 {
            color: #000000;
            font-size: 16px;
            margin-bottom: 12px;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #e0e0e0;
            margin-top: 12px;
        }

        .order-total span {
            font-size: 14px;
            color: #666666;
        }

        .order-total strong {
            font-size: 18px;
            color: #000000;
        }

        .dashboard-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666666;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .dashboard-link:hover {
            color: #000000;
        }

        @media (max-width: 640px) {
            .content {
                padding: 24px;
            }

            .header {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Complete Payment</h1>
            <p>Secure payment powered by Stripe</p>
        </div>
        
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="order-summary">
                <h3>Order Summary</h3>
                <div class="order-total">
                    <span>Total Amount</span>
                    <strong>₱{{ number_format(session('order_total', old('amount', 100)), 2) }}</strong>
                </div>
            </div>

            <div class="form-group">
                <label for="amount">Amount (PHP)</label>
                <div class="amount-input">
                    <span>₱</span>
                    <input type="number" 
                           name="amount" 
                           id="amount"
                           min="50" 
                           step="0.01" 
                           value="{{ session('order_total', old('amount', 100)) }}" 
                           {{ session('order_total') ? 'readonly' : '' }} 
                           required>
                </div>
                @if(session('order_total'))
                    <p class="text-sm text-gray-600 mt-1">Order total from your cart</p>
                @endif
            </div>

            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element"></div>
                <div id="card-errors" class="error" role="alert"></div>
            </div>

            <button id="payButton" type="submit">
                <span id="buttonText">Pay Now</span>
            </button>

            <a href="{{ url('/') }}" class="dashboard-link">Return to Home</a>

            <div id="response"></div>
        </div>
    </div>

    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();
        const card = elements.create('card', {
            style: {
                base: {
                    fontSize: '15px',
                    color: '#000000',
                    '::placeholder': {
                        color: '#999999'
                    }
                }
            }
        });
        card.mount('#card-element');

        const form = document.querySelector('form');
        const payButton = document.getElementById('payButton');
        const buttonText = document.getElementById('buttonText');
        const responseDiv = document.getElementById('response');

        card.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        payButton.addEventListener('click', async (event) => {
            event.preventDefault();
            payButton.disabled = true;
            buttonText.textContent = 'Processing...';

            try {
                const amount = document.getElementById('amount').value;
                const response = await fetch("{{ route('payment.process') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ amount: parseFloat(amount) })
                });

                const data = await response.json();

                if (data.error) {
                    throw new Error(data.error);
                }

                const { error, paymentIntent } = await stripe.confirmCardPayment(data.client_secret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: '{{ Auth::user()->name }}'
                        }
                    }
                });

                if (error) {
                    throw new Error(error.message);
                }

                if (paymentIntent.status === 'succeeded') {
                    window.location.href = "{{ route('payment.success') }}";
                }
            } catch (error) {
                responseDiv.textContent = 'Error: ' + error.message;
                responseDiv.style.display = 'block';
                payButton.disabled = false;
                buttonText.textContent = 'Pay Now';
            }
        });
    </script>
</body>
</html> 