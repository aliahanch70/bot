<?php
$token = "7160750255:AAGX_9Ullz6Nt0pi_bERyplMqbg_C732F6E";
$target_group_id = "-1002614026667"; // آیدی گروه مقصد

// دریافت داده‌های ارسال‌شده از سمت تلگرام (Webhook)
$update = json_decode(file_get_contents("php://input"), true);

// بررسی وجود آپدیت و جلوگیری از پردازش خالی
if (!$update) {
    exit;
}

// بررسی وجود پیام در کانال
if (isset($update["channel_post"])) {
    $channel_chat_id = $update["channel_post"]["chat"]["id"];
    $message_id = $update["channel_post"]["message_id"];

    // فوروارد پیام به گروه
    $url = "https://api.telegram.org/bot$token/forwardMessage?chat_id=$target_group_id&from_chat_id=$channel_chat_id&message_id=$message_id";
    file_get_contents($url);
}

// پاسخ "سلام" به پیام‌های گروه یا چت خصوصی (اختیاری)
if (isset($update["message"]) && isset($update["message"]["text"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode("سلام 😊");
    file_get_contents($url);
}

// ارسال پاسخ به تلگرام برای تأیید دریافت آپدیت
http_response_code(200);
