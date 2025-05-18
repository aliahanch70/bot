<?php
$bot_token = '7458527169:AAHclRKmcrcAD4OSNEJBCM1kP4WvjfXmtCQ'
$api_url = "https://api.telegram.org/bot$bot_token/";



$input = file_get_contents("php://input");
$update = json_decode($input, true);


// آی‌دی شما که ربات باید پیام بفرسته اونجا
$your_id = 140867059;

if (isset($update["message"])) {
    $chat = $update["message"]["chat"];
    $chat_id = $chat["id"];
    $chat_title = $chat["title"] ?? "(private or unnamed)";
    $chat_type = $chat["type"]; // group, supergroup, private

    // فقط اگه پیام از گروه بود
    if ($chat_type === "group" || $chat_type === "supergroup") {
        $text = "🧾 گروه شناسایی شد:\n\nعنوان: $chat_title\nآی‌دی: $chat_id\nنوع: $chat_type";

        // ارسال برای شما
        file_get_contents($api_url . "sendMessage?chat_id=$your_id&text=" . urlencode($text));
    }
}
