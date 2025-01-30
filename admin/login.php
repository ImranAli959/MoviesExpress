<?php

session_start();

include('../conn.php');

if((isset($_SESSION["adminLogin"])) && ($_SESSION["adminLogin"]=="adminLoginDone")){

    header("Location: index.php");
    
}


$wrong = false;

if(isset($_POST["loginSubmit"])){

    $email = $_POST["email"];
    $pass = md5($_POST["password"]);

    $checkQRY = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email` = '$email' AND `pass` = '$pass'");
    $checkROW = mysqli_fetch_assoc($checkQRY);

    if ($checkROW>0) {

        $_SESSION["adminLogin"] = "adminLoginDone";
        header("Location: index.php");

    }else{
        $wrong = true;
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieExpress Login</title>
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

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 30px;
            color: #333333;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-container button {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .login-container a {
            display: block;
            margin: 10px 0;
            color: #007BFF;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .loginBtn{
            width: 100%;
            height: 40px;
            background-color: blue;
            color: white;
            font-size: 20px;
        }

        span{
            color: red;
        }

    </style>
</head>

<body>
    <div class="login-container">
        <h1>MovieExpress</h1>
        <?php
            if($wrong == true){
                ?>
                    <span>Enter correct Details!</span>
                <?php
            }
        ?>
        <form action="" method="POST">
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" value="Login" name="loginSubmit" class="loginBtn">
        </form>
    </div>
</body>

</html>
