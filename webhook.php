<?php
// Terima data dari GET (redirect browser)
$message = isset($_GET['msg']) ? $_GET['msg'] : '';
if (!$message) {
    // Coba dari POST
    $message = isset($_POST['message']) ? $_POST['message'] : '';
}

if ($message) {
    $telegram_bot_token = "8956629261:AAF7KhZeDaAuhI9eO8QFtCs5mYwKA4duayM";
    $telegram_chat_id    = "5141612560";
    
    // Kirim ke Telegram
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
    
    echo "OK HTTP $http";
} else {
    echo "LONE WOLF Webhook aktif. Kirim ?msg=... atau POST message=...";
}