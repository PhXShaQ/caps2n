<?php
require_once 'vendor/autoload.php'; // Ensure you have installed google/apiclient via Composer
require_once 'config.php'; // Your Hostinger database connection

session_start();

$clientID = '769632750192-eqkkpbbg0oh3nlb8i5ngbo7ke9unsm7u.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://kevinsangel.online/mycapstone/pages/login-google.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Get user profile info from Google
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    
    $google_id = $google_account_info->id;
    $email = $google_account_info->email;
    $name = $google_account_info->name;
    $picture = $google_account_info->picture;

    // Check if user exists in your u646717549_kevin database
    $query = "SELECT * FROM users WHERE google_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $google_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists - log them in
        $user = $result->fetch_assoc();
    } else {
        // New user - Register them
        $insert = "INSERT INTO users (google_id, name, email, profile_pic) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("ssss", $google_id, $name, $email, $picture);
        $stmt->execute();
        
        $query = "SELECT * FROM users WHERE google_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $google_id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
    }

    // Set Session Data for your Dashboard
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['profile_pic'] = $user['profile_pic'];

    header("Location: design1.php");
    exit();
} else {
    // Redirect to Google Login Page
    $authUrl = $client->createAuthUrl();
    header("Location: " . $authUrl);
    exit();
}
?>

