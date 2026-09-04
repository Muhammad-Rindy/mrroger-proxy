<?php
$telegram_bot_token = "8956629261:AAF7KhZeDaAuhI9eO8QFtCs5mYwKA4duayM";
$telegram_chat_id    = "5141612560";

if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    $url = "https://api.telegram.org/bot{$telegram_bot_token}/sendMessage?chat_id={$telegram_chat_id}&text=" . urlencode($message);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    curl_close($ch);
    echo "OK";
} else {
    echo "No message";
}