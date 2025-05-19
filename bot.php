<?php
$bot_token = '624118292:AAEmRvq0cXiYkcAph79eATfL8qYbdOkxE40'
$api_url = "https://api.telegram.org/bot$bot_token/";
$update = json_decode(file_get_contents("php://input"), true);


if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];

    // فقط پیام‌های گروه یا سوپرگروه
    $chat_type = $update["message"]["chat"]["type"];
    if ($chat_type === "group" || $chat_type === "supergroup") {
        file_get_contents($api_url . "sendMessage?chat_id=$chat_id&text=سلام 👋");
    }
}
