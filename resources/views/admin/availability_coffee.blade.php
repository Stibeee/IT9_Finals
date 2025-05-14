<!DOCTYPE html>
<html>
<head>
    <title>Coffee Availability</title>
    @include('admin.css')
    <style>
        .availability-toggle {
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .available {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
            border: 1px solid #4CAF50;
        }
        
        .unavailable {
            background-color: rgba(244, 67, 54, 0.1);
            color: #F44336;
            border: 1px solid #F44336;
        }
        
        .availability-toggle:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <h1 class="text-white mb-4;">Coffee Availability</h1>
            <table class="table table-bordered table-hover bg-white rounded shadow">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Availability</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coffee as $item)
                        <tr>
                            <td>{{ $item->coffee_title }}</td>
                            <td>{{ $item->detail }}</td>
                            <td>₱{{ number_format($item->price, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.toggle_coffee', $item->id) }}" 
                                class="availability-toggle {{ $item->availability ? 'available' : 'unavailable' }}">
                                    @if($item->availability)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#4CAF50" height="20" viewBox="0 0 24 24" width="20" style="margin-right: 5px;">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                        <span style="color: #4CAF50; font-weight: bold;">Available</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#FF5252" height="20" viewBox="0 0 24 24" width="20" style="margin-right: 5px;">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                        </svg>
                                        <span style="color: #FF5252; font-weight: bold;">Unavailable</span>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <img src="{{ asset('coffee_img/' . $item->image) }}" width="80" height="80" class="rounded">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.js')
</body>
</html>