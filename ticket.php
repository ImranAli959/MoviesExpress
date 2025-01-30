<?php

session_start();

include('conn.php');

if (empty($_SESSION["login"]) || $_SESSION["login"] == "") {
    header("Location: login.php");
}

$id = $_GET["movieId"];
$movieName = $_GET["movieName"];
$email = $_GET["userEmail"];

$selectQRY = mysqli_query($conn, "SELECT * FROM `booking` WHERE `movie_id` ='$id' AND `userEmail` ='$email' LIMIT 1");
$selectROW = mysqli_fetch_assoc($selectQRY);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieExpress - Your Ticket</title>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .ticket {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .ticket h2 {
            margin-top: 0;
            color: #333;
        }

        .ticket p {
            margin: 10px 0;
            font-size: 18px;
            color: #666;
        }

        .ticket .qr-code {
            margin-top: 20px;
        }

        .ticket .qr-code img {
            width: 150px;
            height: 150px;
        }

        .ticket button {
            margin-top: 20px;
            padding: 15px 30px;
            background-color: #28a745;
            color: #ffffff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .ticket button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>MovieExpress</h1>
    </div>

    <div class="container">
        <div class="ticket">
            <h2>Your Ticket</h2>
            <p><strong>Movie:</strong> <?php echo $movieName; ?></p>
            <p><strong>Seats:</strong> <?php echo $selectROW['seat']; ?></p>

            <button onclick="window.print()">Download Ticket</button>
        </div>
    </div>
</body>

</html>
