<?php
session_start();
include "config.php";

// Set header so the browser knows we are returning JSON
header('Content-Type: application/json');

// 1. TRY RAW INPUT (This is for FETCH JSON)
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// 2. TRY $_POST (Just in case)
$id_token = null;
if (isset($data['token'])) {
    $id_token = $data['token'];
} elseif (isset($_POST['token'])) {
    $id_token = $_POST['token'];
}

// Check if we finally got the token
if (!$id_token) {
    echo json_encode(["success" => false, "message" => "Server still cannot see the token."]);
    exit();
}

// 3. VERIFY WITH GOOGLE
$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
$response = file_get_contents($url);
$payload = json_decode($response, true);

if (isset($payload['email'])) {
    $email = $payload['email'];

    // 4. DATABASE CHECK
    $sql = "SELECT id, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        echo json_encode(["success" => true]);
    } else {
        // If email is not in DB
        echo json_encode(["success" => false, "message" => "Email $email is not registered."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Google rejected the token."]);
}
?>