<?php
session_start();
include "config.php";

// IMPORTANTE: Basahin ang raw input
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['token'])) {
    echo json_encode(["success" => false, "message" => "No token received on the server side."]);
    exit();
}

$id_token = $data['token'];

// I-verify ang token sa Google
$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$payload = json_decode($response, true);

if (isset($payload['email'])) {
    $email = $payload['email'];

    // Check kung ang email ay nasa database na
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
        echo json_encode(["success" => false, "message" => "Email not found in database. Please sign up first."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid Google Token."]);
}
?>