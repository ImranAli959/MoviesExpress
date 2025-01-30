<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieExpress - Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: #007BFF;
            padding: 15px;
            text-align: center;
            color: #fff;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .payment {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .payment h2 {
            margin-top: 0;
            color: #333;
        }

        .payment input[type="text"],
        .payment input[type="number"],
        .payment input[type="email"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .payment button {
            padding: 15px 30px;
            background-color: #28a745;
            color: #ffffff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>MovieExpress</h1>
    </div>

    <div class="container">
        <div class="payment">
            <h2>Enter Payment Details</h2>
            <form action="ticket.php">
                <input type="text" placeholder="Cardholder Name" required>
                <input type="number" placeholder="Card Number" required>
                <input type="text" placeholder="Expiration Date (MM/YY)" required>
                <input type="number" placeholder="CVV" maxlength="3" required>
                <button type="submit">Pay Now</button>
            </form>
        </div>
    </div>
</body>

</html>
