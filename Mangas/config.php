<?php
$servename = "localhost";
$username = "root";
$password = "";
$db = "mangas";



    $conn = new PDO("mysql:host=$servename;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>