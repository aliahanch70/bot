<?php
$bot_token = '7458527169:AAHclRKmcrcAD4OSNEJBCM1kP4WvjfXmtCQ'
$api_url = "https://api.telegram.org/bot$bot_token/";



$input = file_get_contents("php://input");
$update = json_decode($input, true);

// شناسه گروه‌هایی که باید پست‌های کانال بهشون بره
$target_groups = [
    -1001234567890,
    -1009876543210
];

// اگر پست از کانال اومده و باید فوروارد بشه
if (isset($update["channel_post"])) {
    $channel_post = $update["channel_post"];
    $text = $channel_post["text"] ?? $channel_post["caption"] ?? "";
    $channel_chat_id = $channel_post["chat"]["id"];
    $message_id = $channel_post["message_id"];

    // فوروارد به گروه‌ها
    foreach ($target_groups as $group_id) {
        file_get_contents($api_url . "forwardMessage?chat_id=$group_id&from_chat_id=$channel_chat_id&message_id=$message_id");
    }
}

// اگر پیام از گروه یا چت معمولی اومده و می‌خوای ID گروه رو بگیری
if (isset($update["message"])) {
    $message = $update["message"];
    $chat = $message["chat"];

    // فقط وقتی گروه بود
    if ($chat["type"] === "group" || $chat["type"] === "supergroup") {
        $group_id = $chat["id"];

        // ارسال ID گروه به همون گروه
        file_get_contents($api_url . "sendMessage?chat_id=$group_id&text=آیدی این گروه: $group_id");
    }
}
