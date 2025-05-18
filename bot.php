<?php
$bot_token = '7458527169:AAHclRKmcrcAD4OSNEJBCM1kP4WvjfXmtCQ'
$api_url = "https://api.telegram.org/bot$bot_token/";

$input = file_get_contents("php://input");
$update = json_decode($input, true);

file_put_contents("log.txt", file_get_contents("php://input"));

if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];

    // ارسال پاسخ "سلام"
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=سلام 😊");
}

// شناسه گروه‌هایی که باید پست‌ها بهشون برن
$target_groups = [
    -1001234567890,  // گروه اول
    -1009876543210   // گروه دوم
];

if (isset($update["channel_post"])) {
    $channel_post = $update["channel_post"];

    $text = $channel_post["text"] ?? $channel_post["caption"] ?? "";
    $channel_chat_id = $channel_post["chat"]["id"];
    $message_id = $channel_post["message_id"];

    // فوروارد کردن به گروه‌ها
    foreach ($target_groups as $group_id) {
        file_get_contents($api_url . "forwardMessage?chat_id=$group_id&from_chat_id=$channel_chat_id&message_id=$message_id");
    }
}
