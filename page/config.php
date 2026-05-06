<?php
$servername = "localhost";
$username = "u646717549_kevinsangel";
$password = "Kevs09219172474!";
$database = "u646717549_kevin";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>