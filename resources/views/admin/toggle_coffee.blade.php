<!DOCTYPE html>
<html>
<head>
    <title>Toggle Coffee Availability</title>
    @include('admin.css')
    <style>
        .toggle-container {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 20px;
        }
        
        .toggle-status {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .status-available {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
            border: 1px solid #4CAF50;
        }
        
        .status-unavailable {
            background-color: rgba(244, 67, 54, 0.1);
            color: #F44336;
            border: 1px solid #F44336;
        }
        
        .coffee-details {
            margin-top: 15px;
            padding: 10px;
            border-left: 3px solid #795548;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <div class="toggle-container">
                <h3>Toggle Coffee Availability</h3>
                
                <div class="coffee-details">
                    <h4>{{ $coffee->coffee_title }}</h4>
                    <p>{{ $coffee->detail }}</p>
                    <p>Price: ₱{{ number_format($coffee->price, 2) }}</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('admin.toggle_coffee', $coffee->id) }}" 
                           class="toggle-status {{ $coffee->availability ? 'status-available' : 'status-unavailable' }}">
                            @if($coffee->availability)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="20" viewBox="0 0 24 24" width="20" style="margin-right: 8px;">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Currently Available
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="20" viewBox="0 0 24 24" width="20" style="margin-right: 8px;">
                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                </svg>
                                Currently Out of Stock
                            @endif
                        </a>
                    </div>
                </div>

                @if(session('message'))
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('admin.js')
</body>
</html>