<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
    <div class="container">
        <h1>Order Summary</h1>
        <table>
            <tr>
                <th>Order ID</th>
                <td>{{ $order_summary['order_id'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Transaction ID</th>
                <td>{{ $order_summary['transactionId'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $order_summary['date'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>{{ $order_summary['amount'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $order_summary['address'] ?? '' }}</td>
            </tr>
            <tr>
                <th>Order Type</th>
                <td>
                    @if(isset($order_summary['order_type']))
                        @if($order_summary['order_type'] == 0)
                            Self
                        @elseif($order_summary['order_type'] == 1)
                            Provide
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <th>Order Status</th>
                <td> 
                    @if(isset($order_summary['order_status']))
                        @if($order_summary['order_status'] == 1)
                            Accept
                        @elseif($order_summary['order_status'] == 0)
                            Send Order
                        @elseif($order_summary['order_status'] == -1)
                            Cancel Order
                        @elseif($order_summary['order_status'] == 2)
                            Order Dispatch
                        @elseif($order_summary['order_status'] == 3)
                            Payment Process
                        @elseif($order_summary['order_status'] == 4)
                            Order Complete
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <th>Restaurant</th>
                <td>{{ $order_summary['restaurant']['name'] ?? '' }}</td>
            </tr>
            @if(isset($order_summary['order_items']) && count($order_summary['order_items']) > 0)
                @foreach($order_summary['order_items'] as $item)
                    <tr>
                        <th>Item Size</th>
                        <td>{{ $item['size'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>{{ $item['quantity'] ?? '' }}</td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <th>Driver</th>
                <td>{{ $order_summary['driver']['first_name'] ?? '' }} {{ $order_summary['driver']['last_name'] ?? '' }}</td>
            </tr>
            <!-- You can add more rows for other details as needed -->
        </table>
    </div>
</body>
</html>
