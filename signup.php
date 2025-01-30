<?php

session_start();

include('conn.php');

if((isset($_SESSION["login"])) && ($_SESSION["login"]="loginDone")){

    header("Location: index.php");
    
}


$exist = false;

if(isset($_POST["register"])){

    $name = $_POST["fullname"];
    $email = $_POST["email"];
    $pass = md5($_POST["password"]);

    $checkQRY = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'");
    $checkROW = mysqli_fetch_assoc($checkQRY);

    if ($checkROW>0) {
        $exist = true;
    }else{

        $insertQRY = mysqli_query($conn, "INSERT INTO `users`(`name`, `email`, `pass`) VALUES ('$name', '$email', '$pass')");

        if($insertQRY){
            header("Location: login.php");
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieExpress Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-container {
            background-color: #ffffff;
            padding: 40px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .signup-container h1 {
            margin-bottom: 30px;
            color: #333333;
        }

        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .signup-container button {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .signup-container button:hover {
            background-color: #218838;
        }

        .signup-container a {
            display: block;
            margin: 10px 0;
            color: #007BFF;
            text-decoration: none;
        }

        .signup-container a:hover {
            text-decoration: underline;
        }

        span{
            color: red;
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <h1>Create Account</h1>
        <form action="" method="POST">
            <input type="text" placeholder="Full Name" name="fullname" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <?php
            if($exist == true){
                ?>
                    <span>Email Already Exist!</span>
                <?php
            }
            ?>
            <button type="submit" name="register">Sign Up</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>




    <script>
        // Prevent form resubmission prompt by replacing the state after submission
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>
