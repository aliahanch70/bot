<?php
$token = "7160750255:AAGX_9Ullz6Nt0pi_bERyplMqbg_C732F6E";

// لیست گروه‌های مقصد
$target_group_ids = [
    "-1002614026667",
    "-1001098805559",
];

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

    $processed_updates_file = 'processed_updates.txt';
    $file = fopen($processed_updates_file, 'c+');

    if ($file && flock($file, LOCK_EX)) {
        $processed_updates = [];
        while (($line = fgets($file)) !== false) {
            $processed_updates[] = trim($line);
        }

        if (!in_array($update_id, $processed_updates)) {
            // فوروارد به تمام گروه‌های هدف
            foreach ($target_group_ids as $group_id) {
                $url = "https://api.telegram.org/bot$token/forwardMessage?chat_id=$group_id&from_chat_id=$channel_chat_id&message_id=$message_id";
                file_get_contents($url);
            }

            // ثبت شناسه آپدیت
            fseek($file, 0, SEEK_END);
            fwrite($file, $update_id . "\n");
        }

        fflush($file);
        flock($file, LOCK_UN);
    }

    if ($file) {
        fclose($file);
    }
}

http_response_code(200);
