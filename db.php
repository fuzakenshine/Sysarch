<?php
    $con = mysqli_connect("localhost", "root", "", "sitin") or die(mysql_error());
    
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>