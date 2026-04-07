
<?php
header('Content-Type: application/json');

$api_key = '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'; // DOUBLE CHECK THIS

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['audio'])) {
        echo json_encode(['error' => 'No file detected in the request.']);
        exit;
    }

    $file_tmp  = $_FILES['audio']['tmp_name'];
    $file_name = $_FILES['audio']['name'];
    $file_type = $_FILES['audio']['type'];

    $cfile = new CURLFile($file_tmp, $file_type, $file_name);

    $data = [
        'file' => $cfile,
        'model' => 'whisper-1',
        'language' => $_POST['language'] ?? 'en'
    ];

    $ch = curl_init('https://api.openai.com/v1/audio/transcriptions');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $api_key,
        'Content-Type: multipart/form-data'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For localhost SSL issues

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if(curl_errno($ch)) {
        echo json_encode(['error' => 'CURL Error: ' . curl_error($ch)]);
    } else {
        // If OpenAI returns an error, it comes back as JSON. 
        // We pass that directly to your JS.
        echo $response;
    }
    curl_close($ch);
}


