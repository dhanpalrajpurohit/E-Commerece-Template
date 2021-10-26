<?php

$servername = "localhost:3308";
$username = "root";
$password = "";
$database = "dbtermwork";
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>