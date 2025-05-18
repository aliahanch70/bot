<?php
$bot_token = '7458527169:AAHclRKmcrcAD4OSNEJBCM1kP4WvjfXmtCQ'
$api_url = "https://api.telegram.org/bot$bot_token/";

$my_id = 140867059;

$input = file_get_contents("php://input");
file_get_contents($api_url . "sendMessage?chat_id=$my_id&text=" . urlencode($input));
