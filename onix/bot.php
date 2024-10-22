<?php

# -------------- Display Error -------------- #

error_reporting(E_ALL);
ini_set('display_errors', 1);

# -------------- Get Update From Telegram -------------- #

$update = json_decode(file_get_contents("php://input"));

# -------------- Include Essential Module -------------- #

require 'config/config.php';
require 'utils/methods.php';
require 'database/connector.php';
require 'database/usersMethods.php';
require 'utils/keyboards.php';

# -------------- Create Objects -------------- #

$bot = new Bot(API_KEY);
$userCursor = new UserConnection();

# -------------- Include variables -------------- #

require 'utils/variables.php';

# -------------- Main Codes -------------- #
if ($text == '/start' || $text == 'بازگشت') {
    if (!$user) {
        $userCursor->addNewUser($from_id);
    }
    $botMessage = "سلام, به ربات هوش مصنوعی اونیکس خوش آمدید.\n\nجهت ادامه روی یکی از دکمه های زیر کلیک کنید.\n\nساخته شده توسط : *𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺* 🦜";
    $bot->sendMessage($chat_id, $botMessage, $mainKeyboard);
    $userCursor->setStep($from_id, 'home');
    die;
}

if ($text == '「 👨‍💻 چت با هوش مصنوعی 」') {
    $bot->sendMessage($from_id, 'لطفا یکی از نسخه های زیر را انتخاب کنید: ', $aiKeyboard);
    $userCursor->setStep($from_id, 'ai-select-category');
    die;
}
