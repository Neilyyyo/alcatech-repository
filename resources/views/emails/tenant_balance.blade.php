<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Balance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h3 {
            color: #333;
        }
        p {
            color: #555;
        }
        .highlight {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Hello, {{ $tenant->firstName }} {{ $tenant->lastName }}</h1>
    <p>Here is your balance information:</p>
    
    <p><strong>Room:</strong> {{ $tenant->room->roomName ?? 'N/A' }}</p>
    <p><strong>Date In:</strong> {{ \Carbon\Carbon::parse($tenant->date_in)->format('F j, Y') }}</p>
    
    <h3>Payment Summary</h3>
    <p><strong>Rent Price per Month:</strong> {{ number_format($balanceDetails['rentPrice'] ?? 0, 0) }}</p>
    <p><strong>Total Rent Due:</strong> {{ number_format($balanceDetails['totalRentDue'] ?? 0, 0) }}</p>
    <p><strong>Total Paid:</strong> {{ number_format($balanceDetails['totalPaid'] ?? 0, 0) }}</p>
    <p><strong>Outstanding Balance:</strong> <span class="highlight">{{ number_format($balanceDetails['outstandingBalance'] ?? 0, 0) }}</span></p>

    <p>Thank you for being a valued tenant!</p>
</div>

</body>
</html>
