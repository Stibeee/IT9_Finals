<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Register</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

        <style>
            .form-input {
                width: 100%;
                padding: 0.5rem 0.75rem;
                border-radius: 0.375rem;
                border: 1px solid #d1d5db;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }
            .form-input:focus {
                outline: none;
                border-color: #ef4444;
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
            }
            .form-label {
                display: block;
                font-weight: 500;
                font-size: 0.875rem;
                margin-bottom: 0.5rem;
                color: #374151;
            }
            .btn-green {
                background: linear-gradient(135deg, #ef4444, #b91c1c);
                color: white;
                font-weight: 600;
                padding: 0.625rem 1.25rem;
                border-radius: 0.375rem;
                border: none;
                transition: all 0.2s;
            }
            .btn-green:hover {
                background: linear-gradient(135deg, #b91c1c, #991b1b);
                transform: translateY(-1px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
        </style>
    </head>
    <body class="bg-gray-50">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div class="mt-8 mb-8">
                <a href="/">
                    <img src="{{ asset('assets/imgs/logo.png') }}" alt="Espreso Brew" class="h-16 w-auto">
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white p-8 shadow-md overflow-hidden sm:rounded-lg border-t-4 border-red-500">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Register</h1>
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="text-sm text-red-700">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="form-label">Name</label>
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            class="form-input" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            class="form-input" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input 
                            id="phone" 
                            name="phone" 
                            type="text" 
                            class="form-input" 
                            value="{{ old('phone') }}" 
                            required 
                            autocomplete="tel"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="address" class="form-label">Address</label>
                        <input 
                            id="address" 
                            name="address" 
                            type="text" 
                            class="form-input" 
                            value="{{ old('address') }}" 
                            required 
                            autocomplete="street-address"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            class="form-input" 
                            required 
                            autocomplete="new-password"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            class="form-input" 
                            required 
                            autocomplete="new-password"
                        >
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="terms" id="terms" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" required>
                                <span class="ml-2 text-sm text-gray-600">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </span>
                            </label>
                        </div>
                    @endif

                    <div class="flex items-center justify-between mb-6">
                        <a class="text-sm text-gray-600 hover:text-gray-900 underline" href="{{ route('login') }}">
                            Already registered?
                        </a>
                        <button type="submit" class="btn-green">
                            Register
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="mt-6 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} Espreso Brew. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
