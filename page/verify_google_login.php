<?php
session_start();
include "config.php"; // Siguraduhin na ang $conn ay defined dito

// Set header para JSON ang output
header('Content-Type: application/json');

// 1. Kuhanin ang JSON data mula sa Fetch
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// 2. Hanapin ang token (Check JSON or POST)
$id_token = $data['token'] ?? $_POST['token'] ?? null;

if (!$id_token) {
    echo json_encode(["success" => false, "message" => "Server still cannot see the token."]);
    exit();
}

// 3. VERIFY WITH GOOGLE (Using cURL - Mas stable ito sa Hostinger)
$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Minsan kailangan ito sa local dev
$response = curl_exec($ch);
curl_close($ch);

$payload = json_decode($response, true);

if (isset($payload['email'])) {
    $email = $payload['email'];

    // 4. DATABASE CHECK
    // Siguraduhin na ang $conn ay galing sa config.php
    $sql = "SELECT id, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "DB Error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        a
        // Isave sa Session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        
        echo json_encode(["success" => true]);
    } else {
        // Email is valid Google account pero wala sa database mo
        echo json_encode(["success" => false, "message" => "The email $email is not registered in our system."]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Google verification failed or token expired."]);
}

$conn->close();
?>