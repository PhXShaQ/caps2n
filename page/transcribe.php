
<?php
// transcribe.php
header('Content-Type: application/json');

if ($_FILES['audio_data']) {
    $tempFile = $_FILES['audio_data']['tmp_name'];
    $apiKey = '$api_key = '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'; // DOUBLE CHECK THIS'; // Palitan mo ito ng real key mo

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.openai.com/v1/audio/transcriptions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'file' => new CURLFile($tempFile, 'audio/wav', 'recording.wav'),
            'model' => 'whisper-1'
        ],
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $apiKey",
            "Content-Type: multipart/form-data"
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    echo $response; // I-re-return nito ang {"text": "..."}
} else {
    echo json_encode(['error' => 'No audio file received']);
}
?>