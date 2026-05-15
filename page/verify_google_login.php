<?php
session_start();
include "config.php";

// 1. Basahin ang JSON data mula sa 'fetch' body
$input = file_get_contents("php://input");
$request = json_decode($input, true);

if (!isset($request['token'])) {
    echo json_encode(["success" => false, "message" => "No token received."]);
    exit;
}

$id_token = $request['token'];

// 2. I-verify ang token sa Google API
// Gamitin ang file_get_contents para sa simpleng verification (o gamitin ang Google Library)
$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
$response = file_get_contents($url);
$payload = json_decode($response, true);

if (isset($payload['aud']) && $payload['aud'] == "411353244492-m58142v3qbafl7c4lodgv36jd6fsc6m4.apps.googleusercontent.com") {
    
    $email = $payload['email'];
    $full_name = $payload['name'];

    // 3. Check sa database kung existing na ang email
    $sql = "SELECT id, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Existing user: Login agad
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        echo json_encode(["success" => true]);
    } else {
        // New user: I-register muna sa database (Optional)
        // O kaya mag-return ng error na kailangan muna mag-register
        echo json_encode(["success" => false, "message" => "Email not registered in our system."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid Google Token."]);
}
?>