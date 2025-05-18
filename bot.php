<?php

$token = "7458527169:AAHclRKmcrcAD4OSNEJBCM1kP4WvjfXmtCQ";

// دریافت داده‌های ارسال‌شده از سمت تلگرام (Webhook)
$update = json_decode(file_get_contents("php://input"), true);

// بررسی وجود پیام
if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];

    // ارسال پاسخ "سلام"
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=سلام 😊");
}
