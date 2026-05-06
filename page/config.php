

<?php
$host = "localhost";
$user = "u646717549_kevinsangel";
$password = "Kevs09219172474!";
$database = "u646717549_kevin";

$connection = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_error()) {
    echo'error';
}
?>