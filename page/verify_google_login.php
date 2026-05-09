<?php
session_start();
include "config.php"; // Ensure this contains your $conn (mysqli) connection

// Get the JSON data sent from the frontend fetch()
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['token'])) {
    echo json_encode(['success' => false, 'message' => 'No token provided.']);
    exit;
}

$id_token = $data['token'];

// 1. Verify the token using Google's API via cURL
// This is a safe way to verify tokens without needing the full Google PHP Library
$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$payload = json_decode($response, true);

// 2. Check if the token is valid and matches your Client ID
if (isset($payload['aud']) && $payload['aud'] === "997021567508-mh2g2fv9cm60v9gcgstbbjpe8bisp69c.apps.googleusercontent.com") {
    
    $email = $payload['email'];
    $name = $payload['name'];

    // 3. Check if the user already exists in your MySQL 'users' table
    $sql = "SELECT id, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User exists - Log them in
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        
        echo json_encode(['success' => true]);
    } else {
        // User does not exist in your DB
        // OPTIONAL: You can automatically register them here, or return an error
        echo json_encode([
            'success' => false, 
            'message' => 'This Google account is not registered in our system.'
        ]);
    }
    $stmt->close();

} else {
    // Token is invalid or expired
    echo json_encode(['success' => false, 'message' => 'Invalid Google Token.']);
}

$conn->close();
?>