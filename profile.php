<?php
session_start();
include("db.php");

$username = $_SESSION['username'];

// Fetch user data from the database
$query = "SELECT * FROM register WHERE USERNAME = '$username'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['profile_pic'])) {
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
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_FILES['profile_pic'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $midname = $_POST['midname'];
    $course = $_POST['course'];
    $yearlvl = $_POST['yearlvl'];

    // Update user information in the database
    $query = "UPDATE register SET LASTNAME = '$lastname', FIRSTNAME = '$firstname', MIDNAME = '$midname', COURSE = '$course', YEARLVL = '$yearlvl' WHERE USERNAME = '$username'";
    mysqli_query($con, $query);

    echo "Profile updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .form-group input[type="submit"] {
            background: #333;
            color: #fff;
            border: 0;
            padding: 10px 20px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Profile</h2>
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
