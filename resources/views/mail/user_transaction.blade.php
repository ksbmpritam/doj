<!-- resources/views/emails/restaurant_transaction.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success</title>
</head>
<body>
    <p>Hello {{ $emailData['name'] }},</p>

    <p>Your request has been accepted. Your new wallet amount is {{ $emailData['updated_wallet_amount'] }}.</p>

    <p>Thank you for using our service!</p>
</body>
</html>