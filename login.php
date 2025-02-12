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
        $_SESSION['profile_pic'] = !empty($row['PROFILE_PIC']) ? $row['PROFILE_PIC'] : 'default.png'; 
        header("Location: dashboard.php"); // Redirect without alert
        exit();
    } 

    session_start();
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
    }

    header("Location: login.php" . urlencode($error_message));
    exit();
    
        
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