<?php
// I-include ang config para makuha ang tamang session settings
include "config.php"; 

// 1. I-clear ang lahat ng session variables sa memory
$_SESSION = array();

// 2. Burahin ang session cookie sa browser ng user
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. I-destroy ang session sa server
session_destroy();

// 4. I-redirect pabalik sa login page
header("Location: loginform.php");
exit();
?>