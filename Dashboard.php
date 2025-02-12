<?php
session_start();
include("db.php");

$username = $_SESSION['username'];
$query = "SELECT PROFILE_PIC FROM register WHERE USERNAME = '$username'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

// Ensure profile picture exists
$profile_pic = !empty($user['PROFILE_PIC']) ? $user['PROFILE_PIC'] : "default.jpg";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Dashboard</title>
    <style>
        /* Reset some styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Navbar styling */
        .navbar {
            background-image: linear-gradient(to right, rgb(238, 194, 74), rgb(66, 40, 95));
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar .logout-btn {
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .navbar .logout-btn:hover {
            color: gray;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
            font-size: 30px;
        }

        /* Sidebar styling */
        .w3-sidebar {
            height: 100%;
            width: 300px;
            position: fixed;
            top: 0;
            right: 0;
            background-color: #f8f9fa;
            box-shadow: -2px 0 5px rgba(0,0,0,0.2);
            padding-top: 20px;
            text-align: center;
        }

        .w3-sidebar img {
            width: 100px; /* Profile image size */
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 10px auto;
            border: 3px solid #666;
        }

        .w3-sidebar p {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .w3-sidebar a {
            padding: 10px 20px;
            display: block;
            color: black;
            text-decoration: none;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            text-align: center; /* Center the links */
        }

        .w3-sidebar a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="title">Dashboard</div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <div class="w3-sidebar">
    <img src="uploads/<?php echo htmlspecialchars($profile_pic); ?>" 
        alt="Profile Picture" 
        width="100" height="100" 
        style="border-radius: 50%;">

        <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <a href="profile.php">Profile</a>
        <a href="#">Edit</a>
        <a href="#">View Announcement</a>
        <a href="#">View Remaining System</a>
        <a href="#">Lab Rules & Regulations</a>
        <a href="#">History</a>
        <a href="#">Reservation</a>
        <a href="login.php">Logout</a>
    </div>

    <!-- Main content -->
    <div style="margin-right: 260px; padding: 20px;">
        <h2>Welcome to Sit-in Monitoring System</h2>
        <p>This is your dashboard content...</p>
    </div>

</body>
</html>
