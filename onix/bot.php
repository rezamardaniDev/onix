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
require 'database/oneApi.php';

# -------------- Create Objects -------------- #

$bot = new Bot(API_KEY);
$userCursor = new UserConnection();
$apiRequest = new OneApi(RAMZINE);

# -------------- Include variables -------------- #

require 'utils/variables.php';

# -------------- Main Codes -------------- #
if ($text == '/start' || $text == 'بازگشت') {
    if (!$user) {
        $userCursor->addNewUser($from_id);
    }
    if (!$userLimits) {
        $userCursor->addNewUserLimits($from_id);
    }
    $botMessage = "سلام, به ربات هوش مصنوعی اونیکس خوش آمدید.\n\nجهت ادامه روی یکی از دکمه های زیر کلیک کنید.\n\nساخته شده توسط : *𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺* 🦜";
    $bot->sendMessage($chat_id, $botMessage, $mainKeyboard);
    $userCursor->setStep($from_id, 'home');
    die;
}

# -------------- response for first button -------------- #

if ($text == '「 👨‍💻 چت با هوش مصنوعی 」') {
    $bot->sendMessage($from_id, 'لطفا یکی از نسخه های زیر را انتخاب کنید: ', $aiKeyboard);
    $userCursor->setStep($from_id, 'ai-select-category');
    die;
}

# -------------- change the AI type in database -------------- #

if ($user->step == 'ai-select-category') {
    if ($text == 'GPT 3.5') {
        $userCursor->setAiType($from_id, 'gpt-3');
    } elseif ($text == 'GPT 4.O') {
        $userCursor->setAiType($from_id, 'gpt-4');
    } else {
        die;
    }
    $bot->sendMessage($from_id, 'ورژن شما انتخاب شد، هم اکنون میتوانید چت کنید: ', $backButton);
    $userCursor->setStep($from_id, 'chating');
    die;
}

if ($user->step == 'chating') {
    $bot->sendChatAction($chat_id, 'typing');
    $chatResponse = $apiRequest->sendTextToGpt($text, $user->ai_type);
    $bot->sendMessage($from_id, $chatResponse);
    die;
}

if ($text == '「 📡 اخبار روز 」') {
    $news = json_decode(file_get_contents('https://one-api.ir/rss/?token=947925:670026b59af4f&action=irinn'));

    if ($news->status == 200) {
        $bot->sendMessage($from_id, '200');
    }
    die;
}
