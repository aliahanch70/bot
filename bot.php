<?php
$bot_token = '7458527169:AAHclRKmcrcAD4OSNEJBCM1kP4WvjfXmtCQ'
$api_url = "https://api.telegram.org/bot$bot_token/";



$input = file_get_contents("php://input");
file_put_contents("log.txt", $input . PHP_EOL, FILE_APPEND);
