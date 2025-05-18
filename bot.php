<?php
$bot_token = '624118292:AAEmRvq0cXiYkcAph79eATfL8qYbdOkxE40'
$api_url = "https://api.telegram.org/bot$bot_token/";
$input = file_get_contents("php://input");
$update = json_decode($input, true);

// گروه مقصد
$target_group = -1002614026667;
file_put_contents("log.txt", $input); // لاگ گرفتن
// فقط وقتی پست از کانال اومده
if (isset($update["channel_post"])) {
    $channel_post = $update["channel_post"];

    $text = $channel_post["text"] ?? $channel_post["caption"] ?? null;
    $channel_chat_id = $channel_post["chat"]["id"];
    $message_id = $channel_post["message_id"];

    // فوروارد پست به گروه
    file_get_contents($api_url . "forwardMessage?chat_id=$target_group&from_chat_id=$channel_chat_id&message_id=$message_id");
}
