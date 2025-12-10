<?php
header('Content-Type: application/json'); // يحدد نوع الرد JSON
$apiKey = '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';

// استلام الرسالة من الصفحة
$input = json_decode(file_get_contents('php://input'), true);
$message = $input['message'];

// إعداد الرسالة لإرسالها لـ ChatGPT
$data = [
    "model" => "gpt-3.5-turbo",
    "messages" => [
        ["role" => "user", "content" => $message]
    ]
];

// إرسال الطلب لـ OpenAI
$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

// إرسال الرد مرة أخرى للصفحة
echo $response;