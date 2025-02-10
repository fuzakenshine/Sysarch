<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Reset some styles */
        body{
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

        .navbar .title {
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        .navbar .logout-btn {
            color:white;
            padding: 8px 15px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .navbar .logout-btn:hover {
            color : gray;
        }
        h2 {
            text-align: center;
            margin-top: 50px;
            font-size: 30px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="title">Dashboard</div>
        <a href="login.php" class="logout-btn">Logout</a>
    </nav>

    <h2>Welcome to Sit-in Monitoring System</h2>

</body>
</html>
