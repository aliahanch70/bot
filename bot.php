<?php
$bot_token = '624118292:AAEmRvq0cXiYkcAph79eATfL8qYbdOkxE40'
$api_url = "https://api.telegram.org/bot$bot_token/";


$input = file_get_contents("php://input");
$update = json_decode($input, true);

// ID گروه مقصد (مثلاً -1001234567890)
//$target_group_id = -1001098805559;


// چک کردن اینکه آپدیت از نوع پیام متنی هست یا نه
if (isset($update["message"])) {
    $chat = $update["message"]["chat"];

    // فقط اگر نوع چت "private" بود (یعنی پی‌وی)
    if ($chat["type"] === "private") {
        $chat_id = $chat["id"];
        file_get_contents($api_url . "sendMessage?chat_id=$chat_id&text=سلام 🌹");
    }
}
?>
