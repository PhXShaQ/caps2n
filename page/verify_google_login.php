<?php
session_start();
include "config.php"; // Siguraduhing nandito ang database connection ($conn)

header('Content-Type: application/json');

// 1. Kunin ang token mula sa $_POST (dahil URLSearchParams ang pinadala ng JS)
$id_token = isset($_POST['token']) ? trim($_POST['token']) : null;

// Kung talagang walang token na nakuha, mag-stop na at ibalik ang error
if (empty($id_token)) {
    echo json_encode([
        'success' => false,
        'message' => 'No token received on the server side.'
    ]);
    exit;
}

// 2. I-verify ang token gamit ang Google OAuth tokeninfo API
$url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . urlencode($id_token);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$payload = json_decode($response, true);

// 3. Siguraduhing tugma ang Client ID na nasa loginform.php (997021567508-...)
$expected_client_id = "997021567508-chrjcc35gk63aqiiigukc4u2jfu2qdmt.apps.googleusercontent.com";

if (isset($payload['aud']) && $payload['aud'] === $expected_client_id) {
    
    $email = $payload['email'];
    $name = isset($payload['name']) ? $payload['name'] : '';

    // 4. I-check kung registered na ba ang user sa database mo
    $sql = "SELECT id, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // May Account na - I-Log In ang User
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        
        echo json_encode(['success' => true]);
    } else {
        // Kung gusto mo silang i-register agad, maaari kang maglagay ng INSERT query dito.
        // Sa ngayon, ibalik muna natin ang alert na hindi pa sila registered sa DB.
        echo json_encode([
            'success' => false, 
            'message' => 'This Google account is not registered in our system.'
        ]);
    }
    $stmt->close();

} else {
    // Kung peke o expired ang token, o di kaya'y hindi match ang Client ID
    echo json_encode([
        'success' => false, 
        'message' => 'Invalid Google Token or Client ID mismatch.'
    ]);
}

$conn->close();
?>