<?php
    //Database Credentials
    $host = "localhost";
    $db_name = "test";
    $username = "test";
    $password = "test";

    // Create connection
    $conn = mysqli_connect($host, $username, $password, $db_name);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
