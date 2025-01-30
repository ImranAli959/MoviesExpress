<?php

session_start();

include('conn.php');

if((empty($_SESSION["login"])) || ($_SESSION["login"]=="")){

    header("Location: login.php");
    
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieExpress - Home</title>
    <style>

        /* For specific elements */
        .element-with-scroll {
            overflow: scroll; /* Allow scrolling */
            scrollbar-width: none; /* For Firefox */
        }

        /* Hide scrollbar for WebKit browsers */
        .element-with-scroll::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for WebKit browsers */
        ::-webkit-scrollbar {
            display: none;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: #007BFF;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            text-align: center;
            color: #fff;
            position: fixed;
            top: 0;
            width: 100%;
            height: 30px;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .logoutForm{
            margin-right: 50px;
        }

        .logoutBtn{
            color: #007BFF;
            background-color: #fff;
            padding: 8px 20px;
            font-weight: bold;
            font-size: 15px;
            border-radius: 10px;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto 0 auto;
            padding: 20px;
        }

        .movies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .movie-card {
            background-color: #fff;
            padding: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            overflow: hidden;
            border: 2px solid grey;
        }

        .movie-card img {
            max-width: 100%;
            border-radius: 10px;
        }

        .movie-card h3 {
            margin: 15px 0 10px;
            font-size: 18px;
            color: #333;
        }

        .movie-card p {
            margin: 10px 0;
            font-size: 14px;
            color: #777;
        }

        .movie-card button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #ffffff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .movie-card button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>MovieExpress</h1>
        <form action="" method="post" class="logoutForm">
            <input type="submit" value="Logout" name="logout" class="logoutBtn">
        </form>
    </div>

    <div class="container">
        <h2>Now Showing</h2>
        <div class="movies-grid">
            <?php
            
                $movieQRY = mysqli_query($conn, "SELECT * FROM `movies`");

                while($row = mysqli_fetch_assoc($movieQRY)){
                    ?>

                        <div class="movie-card">
                            <img src="img\<?php echo $row['image']?>" alt="Movie">
                            <h3><?php echo $row['name']?></h3>
                            <p>Showtimes: <?php echo $row['timing']?></p>
                            <p>Price: <?php echo $row['price']?></p>
                            <a href="seatSelection.php?id=<?php echo $row['id']?>"><button>Book Now</button></a>
                        </div>

                    <?php
                }

            ?>
            
            <!-- <div class="movie-card">
                <img src="img\ulajh.jpg" alt="Movie 2">
                <h3>ulajh</h3>
                <p>Showtimes: 11:00 AM, 02:00 PM, 05:00 PM, 08:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\kalki.avif" alt="Movie 3">
                <h3>kalki</h3>
                <p>Showtimes: 12:00 PM, 03:00 PM, 06:00 PM, 09:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\khel.jpeg" alt="Movie 4">
                <h3> Khel Khel mein</h3>
                <p>Showtimes: 10:00 AM, 01:00 PM, 04:00 PM, 07:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\ulajh.jpg" alt="Movie 2">
                <h3>ulajh</h3>
                <p>Showtimes: 11:00 AM, 02:00 PM, 05:00 PM, 08:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\kalki.avif" alt="Movie 3">
                <h3>kalki</h3>
                <p>Showtimes: 12:00 PM, 03:00 PM, 06:00 PM, 09:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\stree2.jpeg" alt="Movie 1">
                <h3> Stree 2</h3>
                <p>Showtimes: 10:00 AM, 01:00 PM, 04:00 PM, 07:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\ulajh.jpg" alt="Movie 2">
                <h3>ulajh</h3>
                <p>Showtimes: 11:00 AM, 02:00 PM, 05:00 PM, 08:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\kalki.avif" alt="Movie 3">
                <h3>kalki</h3>
                <p>Showtimes: 12:00 PM, 03:00 PM, 06:00 PM, 09:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\stree2.jpeg" alt="Movie 1">
                <h3> Stree 2</h3>
                <p>Showtimes: 10:00 AM, 01:00 PM, 04:00 PM, 07:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\ulajh.jpg" alt="Movie 2">
                <h3>ulajh</h3>
                <p>Showtimes: 11:00 AM, 02:00 PM, 05:00 PM, 08:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\kalki.avif" alt="Movie 3">
                <h3>kalki</h3>
                <p>Showtimes: 12:00 PM, 03:00 PM, 06:00 PM, 09:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\stree2.jpeg" alt="Movie 1">
                <h3> Stree 2</h3>
                <p>Showtimes: 10:00 AM, 01:00 PM, 04:00 PM, 07:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\ulajh.jpg" alt="Movie 2">
                <h3>ulajh</h3>
                <p>Showtimes: 11:00 AM, 02:00 PM, 05:00 PM, 08:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\kalki.avif" alt="Movie 3">
                <h3>kalki</h3>
                <p>Showtimes: 12:00 PM, 03:00 PM, 06:00 PM, 09:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\stree2.jpeg" alt="Movie 1">
                <h3> Stree 2</h3>
                <p>Showtimes: 10:00 AM, 01:00 PM, 04:00 PM, 07:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\ulajh.jpg" alt="Movie 2">
                <h3>ulajh</h3>
                <p>Showtimes: 11:00 AM, 02:00 PM, 05:00 PM, 08:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\kalki.avif" alt="Movie 3">
                <h3>kalki</h3>
                <p>Showtimes: 12:00 PM, 03:00 PM, 06:00 PM, 09:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\stree2.jpeg" alt="Movie 1">
                <h3> Stree 2</h3>
                <p>Showtimes: 10:00 AM, 01:00 PM, 04:00 PM, 07:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\ulajh.jpg" alt="Movie 2">
                <h3>ulajh</h3>
                <p>Showtimes: 11:00 AM, 02:00 PM, 05:00 PM, 08:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div>
            <div class="movie-card">
                <img src="img\kalki.avif" alt="Movie 3">
                <h3>kalki</h3>
                <p>Showtimes: 12:00 PM, 03:00 PM, 06:00 PM, 09:00 PM</p>
                <button onclick="window.location.href='seatSelection.php'">Book Now</button>
            </div> -->
            <!-- Add more movie cards as needed -->
        </div>
    </div>
</body>

</html>