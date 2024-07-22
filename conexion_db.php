<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "sistemacaccc";

$conn = new mysqli($host, $user, $pass, $db);
mysqli_set_charset($conn, "utf8");


if ($conn->connect_errno) {
    die("Fallo en la conexión: " . $conn->connect_error);
}

?>
