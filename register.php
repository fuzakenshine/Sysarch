<?php
    session_start();  
    include("db.php");

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $lastname = $_POST["lastname"];
            $firstname = $_POST["firstname"];
            $midname = $_POST["midname"];  
            $course = $_POST["course"];
            $yearLevel = $_POST["yearlvl"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $idno = $_POST["idno"];
        
            // Debugging output
            //var_dump($username, $password, !is_numeric($username));
            
            if (!empty($username) && !empty($password) && !is_numeric($username)) {
                $query = "INSERT INTO register 
                (`IDNO`, `LASTNAME`, `FIRSTNAME`, `MIDNAME`, `COURSE`, `YEARLEVEL`, `USERNAME`, `PASSWORD`, `PROFILE_PIC`) 
                VALUES 
                ('$idno', '$lastname', '$firstname', '$midname', '$course', '$yearLevel', '$username', '$password', 'default.jpg')";
            if (mysqli_query($con, $query)) {
                echo "<script type='text/javascript'> alert('Successfully Registered'); window.location.href = 'login.php'; 
              </script>";}
              
              else {
                echo "<script type='text/javascript'> alert('Registration Failed: " . mysqli_error($con) . "');</script>";
            }
            
        }   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container1">
        <div class="navbar">
            <img src="logo1.png" alt="Logo 1" class="logo">
            <img src="logo2.png" alt="Logo 2" class="logo">
        </div>
        <h3>Register</h3>
        <form action="register.php" method="POST">
            <div class="form-control">
                <input type="text" name="idno" required>
                <label>IDNo</label>
            </div>
            <div class="form-control">
                <input type="text" name="lastname" required>
                <label>Lastname</label>
            </div>
            <div class="form-control">
                <input type="text" name="firstname" required>
                <label>Firstname</label>
            </div>
            <div class="form-control">
                <input type="text" name="midname" required>
                <label>Midname</label>
            </div>
            <div class="form-control">
                <input type="text" name="course" required>
                <label>Course</label>
            </div>
            <div class="form-control">
                <input type="text" name="yearlvl" required>
                <label>Year Level</label>
            </div>
            <div class="form-control">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="form-control">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit">Register</button>
            <a class="lgn" href="login.php">Login</a>
        </form>
        </div>
</body>
</html>