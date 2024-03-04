<!DOCTYPE html>
<html>
<head>
    <title>Billing Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .order {
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }
        .restaurant-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }
        .restaurant-details h2 {
            margin-bottom: 10px;
        }
        .restaurant-details p {
            margin: 5px 0;
        }
        .billing-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }
        .billing-details h2 {
            margin-bottom: 10px;
        }
        .billing-details p {
            margin: 5px 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="restaurant-details">
        <h2>Restaurant Details</h2>
        <p><strong>Restaurant Name:</strong> {{ $RestaurantName }}</p>
        <p><strong>Address:</strong><br>{{ $RestaurantAddress }}</p>
        <p><strong>Email:</strong> {{ $RestaurantEmail }}</p>
        <p><strong>Phone:</strong> {{ $RestaurantPhone }}</p>
    </div>
    <div class="billing-details">
        <h2>Billing Details</h2>
        <p><strong>Name:</strong> {{ $CustomerName }}</p>
        <p><strong>Address:</strong><br>{{ $CustomerAddress }}</p>
        <p><strong>Email Address:</strong> {{ $CustomerEmail }}</p>
        <p><strong>Phone:</strong> {{ $CustomerPhone }}</p>
    </div>
    <div class="order">
    <h3 class="text-center">Order Items</h3>
    <table>
        <thead>
            <tr>
                <th>Items</th>
                <th>Price</th>
                <th>QTY</th>
                <th>Size</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($orderArray as $order)
                <tr>
                    <td>{{ $order['Itms'] }}</td>
                    <td>{{ $order['Price'] }}</td>
                    <td>{{ $order['QTY'] }}</td>
                    <td>{{ $order['Size'] }}</td>
                    
                </tr>
            @endforeach
        </tbody>
        <thead>
            <tr>
                <th colspan="3">Total</th>
                <td>{{ $order['Total']}}</td>
                </tr>
        </thead>
        
    </table>
    </div>
</body>
</html>
