<?php
// save_voice.php
if (isset($_FILES['audio_file'])) {
    $uploadDir = 'uploads/recordings/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $filename = 'voice_' . time() . '.mp3';
    $uploadFile = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['audio_file']['tmp_name'], $uploadFile)) {
        echo json_encode(['status' => 'success', 'path' => $uploadFile]);
    } else {
        echo json_encode(['status' => 'error']);
    }
}
?>