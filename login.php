<?php
session_start();
include("db.php"); // Ensure this connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if user exists
    $query = "SELECT * FROM register WHERE USERNAME='$username' AND PASSWORD='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // User found, start session
        $_SESSION["username"] = $username;
        echo "<script>alert('Login Successful'); window.location.href = 'dashboard.php';</script>";
    } else {
        // Invalid login
        echo "<script>alert('Invalid Username or Password'); window.location.href = 'login.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CCS Sitin Monitoring System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="navbar">
                <img src="logo1.png" alt="Logo 1" class="logo">
                <img src="logo2.png" alt="Logo 2" class="logo">
            </div>
            <h2>CCS Sitin Monitoring System</h2>
            <form action="login.php" method="POST">
                <div class="form-control">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="form-control">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit">Login</button>
               <a href="register.php">Register</a>
            </form>
        </div>
        <script src="" async defer></script>
    </body>
</html>