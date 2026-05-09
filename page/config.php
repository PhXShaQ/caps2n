<?php

// 1. I-set ang haba ng buhay ng Session Cookie (30 days * 24 hours * 60 mins * 60 secs)
$cookie_lifetime = 30 * 24 * 60 * 60; 

// 2. I-configure ang session cookie bago mag-session_start()
session_set_cookie_params([
    'lifetime' => $cookie_lifetime,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => false,    // I-set sa true kung may SSL/HTTPS na ang Hostinger site mo
    'httponly' => true,   // Panangga sa XSS attacks
    'samesite' => 'Lax'
]);

// 3. I-set ang garbage collection lifetime para hindi burahin ng server ang session file
ini_set('session.gc_maxlifetime', $cookie_lifetime);

// 4. Simulan ang session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "u646717549_kevinsangel";
$password = "Kevs09219172474!";
$database = "u646717549_kevin";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>