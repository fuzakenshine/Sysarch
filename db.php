<?php
// Database connection file
$con = mysqli_connect("localhost", "root", "", "sitin");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}