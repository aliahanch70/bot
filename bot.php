<?php
$token = "7160750255:AAGX_9Ullz6Nt0pi_bERyplMqbg_C732F6E";
$target_group_id = "-1002614026667"; // آیدی گروه مقصد

// دریافت داده‌های ارسال‌شده از سمت تلگرام (Webhook)
$update = json_decode(file_get_contents("php://input"), true);

// بررسی وجود پیام در کانال
if (isset($update["channel_post"])) {
    $channel_chat_id = $update["channel_post"]["chat"]["id"];
    $message_id = $update["channel_post"]["message_id"];

    // فوروارد پیام به گروه
    $url = "https://api.telegram.org/bot$token/forwardMessage?chat_id=$target_group_id&from_chat_id=$channel_chat_id&message_id=$message_id";
    file_get_contents($url);
}
