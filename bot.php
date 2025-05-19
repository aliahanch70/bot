<?php
$token = "7160750255:AAGX_9Ullz6Nt0pi_bERyplMqbg_C732F6E";
$target_group_id = "-1001098805559"; // آیدی گروه مقصد

// دریافت داده‌های ارسال‌شده از سمت تلگرام (Webhook)
$update = json_decode(file_get_contents("php://input"), true);

// بررسی وجود آپدیت و جلوگیری از پردازش خالی
if (!$update) {
    http_response_code(200);
    exit;
}

// بررسی وجود پیام در کانال
if (isset($update["channel_post"])) {
    $channel_chat_id = $update["channel_post"]["chat"]["id"];
    $message_id = $update["channel_post"]["message_id"];
    $update_id = $update["update_id"]; // شناسه منحصربه‌فرد آپدیت

    // بررسی آپدیت تکراری با استفاده از فایل لاگ ساده
    $processed_updates_file = 'processed_updates.txt';
    $processed_updates = file_exists($processed_updates_file) ? file($processed_updates_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

    if (!in_array($update_id, $processed_updates)) {
        // فوروارد پیام به گروه
        $url = "https://api.telegram.org/bot$token/forwardMessage?chat_id=$target_group_id&from_chat_id=$channel_chat_id&message_id=$message_id";
        file_get_contents($url);

        // ثبت آپدیت پردازش‌شده
        file_put_contents($processed_updates_file, $update_id . "\n", FILE_APPEND);
    }
}

// پاسخ "سلام" به پیام‌های گروه یا چت خصوصی  خصوصی (اختیاری)
if (isset($update["message"]) && isset($update["message"]["text"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode("سلام 😊");
    file_get_contents($url);
}

// ارسال پاسخ به تلگرام برای تأیید دریافت آپدیت
http_response_code(200);
