<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "moviesexpress";

$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn){
    ?>

    <script>
        alert("Database connection ERROR");
    </script>

    <?php
}

?>