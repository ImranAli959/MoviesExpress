<?php
session_start();

include('conn.php');

if (empty($_SESSION["login"]) || $_SESSION["login"] == "") {
    header("Location: login.php");
}

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("Invalid movie ID.");
}

$id = $_GET["id"];

$fetchQRY = mysqli_query($conn, "SELECT * FROM `movies` WHERE `id` = '$id'");
if (!$fetchQRY) {
    die("Query failed: " . mysqli_error($conn));
}
$movieROW = mysqli_fetch_assoc($fetchQRY);

$movieName = $movieROW['name'];

$bookingFailed = false;

// Fetch booked seats for this movie
$bookedSeats = [];
$bookedQRY = mysqli_query($conn, "SELECT seat FROM booking WHERE movie_id = '$id'");

while ($row = mysqli_fetch_assoc($bookedQRY)) {
    // Split the string into an array and merge it into $bookedSeats
    $bookedSeats = array_merge($bookedSeats, explode(",", $row['seat']));
}

if (isset($_POST['submitBook'])) {
    $movieId = $_POST['movieId'];
    $userEmail = $_POST['userEmail'];
    $selectedSeats = $_POST['seats']; // This will be an array of selected seats

    // Insert booking into the database
    $insertBooking = mysqli_query($conn, "INSERT INTO `booking` (movie_id, userEmail, seat) VALUES ('$movieId', '$userEmail', '" . implode(",", $selectedSeats) . "')");
    if ($insertBooking) {
        header("Location: ticket.php?movieId=$movieId&userEmail=$userEmail&movieName=$movieName");
    } else {
        $bookingFailed = true;
        echo "Booking failed: " . mysqli_error($conn); // Debugging output
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieExpress - Select Your Seats</title>
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

        .seat-selection {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .seat-selection h2 {
            margin-top: 0;
            color: #333;
        }

        .seat-grid {
            display: grid;
            grid-template-columns: repeat(8, 50px);
            grid-gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .seat {
            width: 30px;
            height: 30px;
            background-color: #cccccc;
            border-radius: 5px;
            cursor: pointer;
        }

        .seat.selected {
            background-color: #28a745;
        }

        .seat.unavailable {
            background-color: #d9534f;
            cursor: not-allowed;
        }

        .seat:hover:not(.unavailable) {
            background-color: #0056b3;
        }

        .seat-selection button {
            padding: 15px 30px;
            background-color: #28a745;
            color: #ffffff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .seat-selection button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>MovieExpress</h1>
    </div>

    <div class="container">
        <div class="seat-selection">
            <h2>Select Your Seats for <?php echo $movieROW['name']; ?></h2>
            <?php
            if ($bookingFailed == true) {
                ?>
                <h3 style="color: red;">Booking Failed</h3>
                <?php
            }
            ?>
            <h4>The Screen Is Here</h4>
            <form action="" method="post">
                <div class="seat-grid">
                    <input type="hidden" name="movieId" value="<?php echo $movieROW['id']; ?>">
                    <input type="hidden" name="userEmail" value="<?php echo $_SESSION["userEmail"]; ?>">

                    <?php
                    // Generate checkboxes for seats
                    for ($i = 1; $i <= 40; $i++) {
                        $seatValue = "seat$i"; // Generate seat value
                        $isBooked = in_array($seatValue, $bookedSeats); // Check if the seat is booked
                        $disabled = $isBooked ? "disabled" : ""; // Disable if booked
                        $checked = $isBooked ? "checked" : ""; // Check if the seat is already booked
                        ?>
                        <input type="checkbox" class="seat" name="seats[]" value="<?php echo $seatValue; ?>" onclick="updateTotal(this)" <?php echo $disabled; ?> <?php echo $checked; ?>>
                        <?php
                    }
                    ?>
                </div>
                <button name="submitBook" id="paymentButton" type="submit">Proceed to Payment (₹0)</button>
            </form>
        </div>
    </div>

    <script>
        const seatPrice = <?php echo $movieROW['price']; ?>;  // Set price for each seat
        let total = 0;

        function updateTotal(checkbox) {
            if (checkbox.checked) {
                total += seatPrice;
            } else {
                total -= seatPrice;
            }
            document.getElementById("paymentButton").innerText = `Proceed to Payment (₹${total})`;
        }
    </script>
</body>

</html>
