<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Espreso Brew</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23a7f3d0' fill-opacity='0.3'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .header-wrapper {
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
        }
        .header-wrapper::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #10B981, #3B82F6);
        }
        .success-card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            transform: translateY(0);
        }
        .success-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .card-header {
            background: linear-gradient(135deg, #10B981, #059669);
            padding: 1.5rem;
            text-align: center;
        }
        .success-icon {
            height: 80px;
            width: 80px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
            animation: pulse 2s infinite;
        }
        .success-icon svg {
            color: #059669;
            height: 40px;
            width: 40px;
        }
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.4);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(5, 150, 105, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
            }
        }
        .payment-details {
            background-color: #f8fafc;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .btn {
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6B7280, #4B5563);
            color: white;
        }
        .btn-secondary:hover {
            background: linear-gradient(135deg, #4B5563, #374151);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .divider {
            height: 1px;
            width: 100%;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.3), transparent);
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="header-wrapper">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/imgs/logo.png') }}" class="h-10 w-auto mr-3" alt="Espreso Brew">
                        <h1 class="text-xl font-semibold text-gray-800">Payment Successful</h1>
                    </div>
                    <nav>
                        <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 font-medium transition duration-300">
                            <span class="mr-1">&#8592;</span> Home
                        </a>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow py-12">
            <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
                <div class="success-card bg-white">
                    <!-- Card Header with Success Icon -->
                    <div class="card-header">
                        <div class="success-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="p-8">
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Payment Successful!</h2>
                            <p class="text-gray-600 mb-6">Thank you for your purchase. Your payment has been processed successfully.</p>
                            
                            <!-- Payment Details -->
                            @if(session('payment'))
                                <div class="payment-details mb-8 mx-auto">
                                    <h3 class="font-semibold text-gray-700 mb-4 text-left">Payment Details</h3>
                                    
                                    <div class="grid grid-cols-2 gap-3 text-left">
                                        <span class="text-gray-600 font-medium">Payment ID:</span>
                                        <span class="font-semibold text-right text-gray-800">{{ session('payment')->stripe_payment_id }}</span>
                                        
                                        <span class="text-gray-600 font-medium">Amount:</span>
                                        <span class="font-semibold text-right text-green-600">₱{{ number_format(session('payment')->amount, 2) }}</span>
                                        
                                        <span class="text-gray-600 font-medium">Date:</span>
                                        <span class="font-semibold text-right text-gray-800">{{ session('payment')->created_at->format('M d, Y H:i:s') }}</span>
                                    </div>
                                </div>
                            @endif

                            <div class="divider"></div>
                            
                            <!-- Action Buttons -->
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('payment.form') }}" class="btn btn-primary">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Make Another Payment
                                </a>
                                <a href="{{ url('/') }}" class="btn btn-secondary">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Return to Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="text-center text-sm text-gray-500">
                    <p>&copy; {{ date('Y') }} Espreso Brew. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Confetti Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple confetti effect
            const colors = ['#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6'];
            const numConfetti = 150;
            
            function createConfetti() {
                for (let i = 0; i < numConfetti; i++) {
                    const confetti = document.createElement('div');
                    confetti.style.position = 'fixed';
                    confetti.style.width = Math.random() * 10 + 5 + 'px';
                    confetti.style.height = Math.random() * 10 + 5 + 'px';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.borderRadius = '50%';
                    confetti.style.opacity = Math.random();
                    confetti.style.top = '-10px';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.zIndex = '1000';
                    confetti.style.pointerEvents = 'none';
                    
                    document.body.appendChild(confetti);
                    
                    const animation = confetti.animate([
                        { transform: 'translateY(0) rotate(0deg)', opacity: Math.random() },
                        { transform: `translateY(${Math.random() * 100 + 100}vh) rotate(${Math.random() * 360}deg)`, opacity: 0 }
                    ], {
                        duration: Math.random() * 2000 + 2000,
                        easing: 'cubic-bezier(0.37, 0, 0.63, 1)'
                    });
                    
                    animation.onfinish = () => {
                        confetti.remove();
                    };
                }
            }
            
            // Trigger confetti animation with a slight delay
            setTimeout(createConfetti, 500);
        });
    </script>
</body>
</html>
