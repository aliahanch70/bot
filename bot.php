<?php
$bot_token = '624118292:AAEmRvq0cXiYkcAph79eATfL8qYbdOkxE40'
$api_url = "https://api.telegram.org/bot$bot_token/";
$update = json_decode(file_get_contents("php://input"), true);

if (!$update) {
    exit;
}

// اگر پیام جدید وجود داشته باشه
if (isset($update["message"])) {
    $message = $update["message"];
    $chat_id = $message["chat"]["id"];
    $type = $message["chat"]["type"];

    // فقط گروه یا سوپرگروه باشه
    if ($type === "group" || $type === "supergroup") {
        // بررسی اینکه پیام از یک کاربر هست، نه خود ربات
        if (isset($message["new_chat_members"])) {
            foreach ($message["new_chat_members"] as $member) {
                if ($member["username"] === "YourBotUsername") { // نام کاربری ربات بدون @
                    // ربات اضافه شده => سلام بده
                    file_get_contents($api_url . "sendMessage?chat_id=$chat_id&text=سلام! من اضافه شدم 🌟");
                    break;
                }
            }
        } else {
            // پیام معمولی دریافت شده => سلام بده
            file_get_contents($api_url . "sendMessage?chat_id=$chat_id&text=سلام 👋");
        }
    }
}
