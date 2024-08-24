<?php
$servername = "localhost";
$username = "capstone";
$password = "aegislegend";
$dbname = "interlink";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>