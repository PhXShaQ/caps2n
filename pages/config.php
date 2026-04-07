<?php
$host = "localhost"; // Madalas localhost pa rin sa Hostinger
$db_user = "u646717549_kevinsangel"; // Yung galing sa MySQL Databases menu
$db_pass = "Kevs09219172474"; 
$db_name = "u646717549_kevin";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>