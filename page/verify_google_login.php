<?php
session_start();
include "config.php";

// Set header
header('Content-Type: application/json');

// Sa bagong JS code sa taas, dapat nasa $_POST na ang token
$id_token = $_POST['token'] ?? null;

if (!$id_token) {
    echo json_encode(["success" => false, "message" => "Server still cannot see the token. Please check network tab."]);
    exit();
}

// Verification via Google
$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
$response = file_get_contents($url); // Subukan muna ito, kung ayaw, gamitin ang cURL version sa taas
$payload = json_decode($response, true);

if (isset($payload['email'])) {
    $email = $payload['email'];

    // Database Check
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
        echo json_encode(["success" => false, "message" => "Email $email not registered in database."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Google Token Invalid."]);
}
?>