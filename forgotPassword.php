<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieExpress Forgot Password</title>
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

        .forgot-password-container {
            background-color: #ffffff;
            padding: 40px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .forgot-password-container h1 {
            margin-bottom: 30px;
            color: #333333;
        }

        .forgot-password-container input[type="email"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .forgot-password-container button {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            background-color: #ffc107;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .forgot-password-container button:hover {
            background-color: #e0a800;
        }

        .forgot-password-container a {
            display: block;
            margin: 10px 0;
            color: #007BFF;
            text-decoration: none;
        }

        .forgot-password-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="forgot-password-container">
        <h1>Forgot Password</h1>
        <form action="password-reset-success.html">
            <input type="email" placeholder="Enter your email" name="email" required>
            <button type="submit">Reset Password</button>
        </form>
        <a href="login.html">Back to Login</a>
    </div>
</body>

</html>
