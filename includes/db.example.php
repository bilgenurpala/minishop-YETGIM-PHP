<?php
$servername = "localhost";
$username = "DB_USERNAME";
$password = "DB_PASSWORD";
$database = "DB_NAME";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Database connection error.");
}

mysqli_set_charset($conn, "utf8");
?>
