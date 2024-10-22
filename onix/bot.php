<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$update = json_decode(file_get_contents("php://input"));

include 'config/config.php';
include 'utils/methods.php';
include 'utils/variables.php';

$bot = new Bot(API_KEY);


if ($text == '/start') {
    $bot->sendMessage($chat_id, 'سلام دوست عزیز');
    die;
}
