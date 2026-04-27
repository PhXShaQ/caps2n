<php 
error_reporting(E_ALL);
var_dump(password_hash ("test", PASSWORD_ARGON2ID));
?>