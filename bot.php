<?php
$bot_token = '7458527169:AAHclRKmcrcAD4OSNEJBCM1kP4WvjfXmtCQ'
$api_url = "https://api.telegram.org/bot$bot_token/";

$input = file_get_contents("php://input");
error_log("Received update: " . $input);

// برای تست پیام ساده به خودت بفرست
$my_id = 140867059;
file_get_contents($api_url . "sendMessage?chat_id=$my_id&text=" . urlencode("Got update!"));

echo "ok";
