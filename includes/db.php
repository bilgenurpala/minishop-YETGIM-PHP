<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "urun_katalogu";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Veritabanı bağlantı hatası: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>

