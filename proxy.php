<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$telegram_bot_token = "8956629261:AAF7KhZeDaAuhI9eO8QFtCs5mYwKA4duayM"; // Ganti dengan token bot kamu
$telegram_chat_id    = "5141612560"; // Ganti dengan chat ID kamu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $message = $data['message'] ?? '';

    if ($message) {
        $url = "https://api.telegram.org/bot{$telegram_bot_token}/sendMessage";
        $post_data = [
            'chat_id' => $telegram_chat_id,
            'text' => $message
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        echo json_encode(['status' => 'success', 'response' => $response]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No message provided']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Only POST allowed']);
}