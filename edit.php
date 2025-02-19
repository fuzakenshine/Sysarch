<?php
session_start();
include("db.php");

$username = $_SESSION['username'];

// Fetch user data from the database
$query = "SELECT * FROM register WHERE USERNAME = '$username'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['profile_pic'])) {
        $target_dir = "uploads/";

        // Get file details
        $file_name = basename($_FILES["profile_pic"]["name"]);
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        $file_size = $_FILES["profile_pic"]["size"];

        // Validate file type
        if (!in_array($file_type, $allowed_types)) {
            echo "Error: Only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        // Validate file size (max 2MB)
        if ($file_size > 2 * 1024 * 1024) { 
            echo "Error: File size should not exceed 2MB.";
            exit();
        }

        // Rename file to prevent overwrites (Example: user_123456789.jpg)
        $new_file_name = "user_" . time() . "." . $file_type;
        $target_file = $target_dir . $new_file_name;

        // Move uploaded file to "uploads" folder
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            // Update profile picture in database
            $query = "UPDATE register SET PROFILE_PIC = '$new_file_name' WHERE USERNAME = '$username'";
            mysqli_query($con, $query);

            // Update session with new image
            $_SESSION['PROFILE_PIC'] = $new_file_name;
            header("Location: dashboard.php"); 
            echo "Profile picture updated successfully!";
        } else {
            echo "Error uploading file.";
        }
    } else {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $midname = $_POST['midname'];
        $course = $_POST['course'];
        $yearlvl = $_POST['yearlvl'];

        // Update user information in the database
        $query = "UPDATE register SET LASTNAME = '$lastname', FIRSTNAME = '$firstname', MIDNAME = '$midname', COURSE = '$course', YEARLEVEL = '$yearlvl' WHERE USERNAME = '$username'";
        mysqli_query($con, $query);

        echo "Profile updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-image: linear-gradient(to right, rgb(0, 0, 0), rgb(0, 0, 0));
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
        .container {
            max-width: 600px; /* Reduce the width */
            margin-left: 300px; /* Center the container */
            padding: 20px;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow */
        }   
        .form-group {
            text-align: center; /* Center labels and inputs */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="file"] {
            width: 80%; /* Adjust width */
            padding: 10px;
            box-sizing: border-box;
            text-align: center; /* Center text in inputs */
        }

        .form-group input[type="submit"] {
            background: #333;
            color: #fff;
            border: 0;
            padding: 10px 20px;
            cursor: pointer;
            width: 50%;
        }

        .form-group input[type="submit"]:hover {
            background: #555;
        }
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
            text-align: LEFT; /* Center the links */
        }
        .w3-sidebar a:hover {
            background-color: #ddd;
        }
        .h2 {
            
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="dashboard.php" style="text-decoration: none;"><div class="title">Dashboard</div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <div class="w3-sidebar">
        <img src="uploads/<?php echo htmlspecialchars($user['PROFILE_PIC']); ?>" alt="Profile Picture" width="100" height="100" style="border-radius: 50%;">
        <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="edit.php"><i class="fas fa-edit"></i> Edit</a>
        <a href="#"><i class="fas fa-bullhorn"></i> View Announcement</a>
        <a href="#"><i class="fas fa-tasks"></i> View Remaining System</a>
        <a href="#"><i class="fas fa-book"></i> Lab Rules & Regulations</a>
        <a href="#"><i class="fas fa-history"></i> History</a>
        <a href="#"><i class="fas fa-calendar-alt"></i> Reservation</a>
        <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="container">
        <h2 style="text-align: center; font-weight: 800;">Update Profile</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="idno">ID Number</label>
                <input type="text" id="idno" name="idno" value="<?php echo htmlspecialchars($user['IDNO']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['LASTNAME']); ?>" required>
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['FIRSTNAME']); ?>" required>
            </div>
            <div class="form-group">
                <label for="midname">Midname</label>
                <input type="text" id="midname" name="midname" value="<?php echo htmlspecialchars($user['MIDNAME']); ?>" required>
            </div>
            <div class="form-group">
                <label for="course">Course</label>
                <input type="text" id="course" name="course" value="<?php echo htmlspecialchars($user['COURSE']); ?>" required>
            </div>
            <div class="form-group">
                <label for="yearlvl">Year Level</label>
                <input type="text" id="yearlvl" name="yearlvl" value="<?php echo htmlspecialchars($user['YEARLEVEL']); ?>" required>
            </div>
            <div class="form-group">
                <label for="profile_pic">Profile Picture</label>
                <input type="file" id="profile_pic" name="profile_pic">
            </div>
            <div class="form-group">
                <input type="submit" value="Update Profile">
            </div>
        </form>
    </div>
</body>
</html>
