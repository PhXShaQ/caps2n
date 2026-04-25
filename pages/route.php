<?php
$code = $_GET['code'];

// manual mapping (no database yet)
$routes = [
    "abc123" => "homepage",
    "dash99" => "designhome",
    "prof88" => "design1"
];

if (array_key_exists($code, $routes)) {
    include $routes[$code] . ".php";
} else {
    echo "Page not found";
}
?>
<?php
$code = $_GET['code'];

// TEMP: redirect to designhome page
include "designhome.php";
?>