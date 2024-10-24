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
    $botMessage = "سلام, به ربات هوش مصنوعی اونیکس خوش آمدید.\n\nجهت ادامه روی یکی از دکمه های زیر کلیک کنید.\n\n" . '<b>' . "ساخته شده توسط : " . '<a href="' . 'https://t.me/OnyxAiTeam' . '">*𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺* 🦜</a>' . '</b>';
    $bot->sendMessage($chat_id, $botMessage, $mainKeyboard);
    $userCursor->setStep($from_id, 'home');
    die;
}

# -------------- include ai section -------------- #

include 'partial/chatBotSection.php';

# -------------- include news section -------------- #

if ($text == '「 📡 اخبار روز 」') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->getNews();
    $bot->sendMessage($from_id, $response);
}

# -------------- completing prices section -------------- #

if ($text == '「 💵 نرخ ارز و طلا 」') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->getCurrency();
    require 'partial/currencyPrice.php'; 
    $bot->sendMessage($from_id, "🔴 نرخ بازار ارز به صورت لحظه ای به شرح زیر می باشد:", json_encode($pricesKeyboard));
    die;
}

if ($text == '「 ✉️ فال حافظ 」' || $text == 'فال مجدد') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->falHafez();
    $botMessage = '<b>' . "{$response->result->TITLE}" . '</b>' . "\n\n {$response->result->RHYME}\n\n {$response->result->MEANING}\n\nشماره: {$response->result->SHOMARE}";
    $bot->sendMessage($from_id, $botMessage, $falKeyboard);
    die;
}
