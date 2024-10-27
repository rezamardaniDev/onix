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
require 'partial/botMessages.php';

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

# -------------- prices of gold and money -------------- #

if ($text == '「 💵 نرخ ارز و طلا 」') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->getCurrency();
    require 'partial/currencyPrice.php';
    $bot->sendMessage($from_id, "🔴 نرخ بازار ارز به صورت لحظه ای به شرح زیر می باشد:", json_encode($pricesKeyboard));
    die;
}

# -------------- get hafez fal -------------- #

if ($text == '「 ✉️ فال حافظ 」' || $data == 'fal') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->funnyService('hafez');
    $botMessage = '<b>' . "{$response->result->TITLE}" . '</b>' . "\n\n {$response->result->RHYME}\n\n {$response->result->MEANING}\n\nشماره: {$response->result->SHOMARE}";

    if ($text) {
        $bot->sendMessage($from_id, $botMessage, $falKeyboard);
    } else {
        $bot->editMessage($from_id, $botMessage, $message_id, $falKeyboard);
    }
    die;
}

# -------------- get danestani -------------- #

if ($text == '「 ⁉️ دانستنی 」' || $data == 'danestani') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->funnyService('danestani');
    $botMessage = $response->result->Content;

    if ($text) {
        $bot->sendMessage($from_id, $botMessage, $danestaniKeyboard);
    } else {
        $bot->editMessage($from_id, $botMessage, $message_id, $danestaniKeyboard);
    }
    die;
}

# -------------- get random joke -------------- #

if ($text == '「 🤡 جوکستان 」' || $data == 'joke') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->funnyService('joke');
    $botMessage = $response->result;

    if ($text) {
        $bot->sendMessage($from_id, $botMessage, $jokeKeyboard);
    } else {
        $bot->editMessage($from_id, $botMessage, $message_id, $jokeKeyboard);
    }
    die;
}

# -------------- get city oghat -------------- #

if ($text == '「 🕌 اوقات شرعی 」') {
    $bot->sendMessage($from_id, 'لطفا نام شهر مورد نظر خود را وارد کنید: ', $backButton);
    $userCursor->setStep($from_id, 'get-oghat');
    die;
}

if ($user->step == 'get-oghat') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->oghatSharie($text);

    if ($response->status != 200) {
        $bot->sendMessage($from_id,  'خطایی در جستجوی شهر مورد نظر رخ داد!', $mainKeyboard);
        die;
    }

    require 'partial/oghatVariables.php';

    $botMessage = $shahr . $sob . $tloe . $zohr . $ghrob . $mghreb . $nimeShab . "برای جستجوی مجدد نام شهر را ارسال کنید";
    $bot->sendMessage($from_id, $botMessage, $backButton);
    die;
}

# -------------- get crypto price -------------- #

if ($text == '「 📊 ارز دیجیتال 」') {
    $botMessage = $crypto_text;
    $bot->sendMessage($from_id, $botMessage, $backButton);
}

if (in_array($text, $crypto_list) || in_array(explode(' ', $text, 2)[1], $crypto_list)) {
    if (in_array($text, $crypto_list)) {
        $price = 1;
        $formatter[1] = $text;
    } else {
        $formatter = explode(' ', $text, 2);
        $formatter[0] = $bot->convertFaToEn($formatter[0]);

        if (preg_match('/^[1-9]\d*/', $formatter[0]) && in_array($formatter[1], $crypto_list)) {
            $price = $formatter[0];
        }
    }
    require 'partial/crypto.php';
    die;
}

# -------------- get user area -------------- #

if ($text == '「 👤 حساب کاربری 」') {
    $bot->sendChatAction($chat_id, 'typing');
    require 'partial/botMessages.php';
    $bot->sendMessage($from_id, $user_area);
    die;
}

# -------------- get help button -------------- #

if ($text == '「 🆘 راهنما 」') {
    $bot->sendMessage($from_id, 'لطفا یکی از گزینه های زیر را انتخاب کنید', $helpButton);
    die;
}
require 'partial/helpButtonText.php';

if ($text == 'لوگو اسم') {
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, 'اسم مورد نظر خود را برای ساخت لوگو به انگلیسی وارد کنید: ', $backButton);
    $userCursor->setStep($from_id, 'cr-logo');
    die;
}

if ($user->step == 'cr-logo') {
    $bot->sendChatAction($from_id, 'upload_photo');
    $response = $apiRequest->makeLogo($text);
    $bot->sendPhoto($from_id, $response, 'لوگو اسم شما آماده شد!', $mainKeyboard);
    $userCursor->setStep($from_id, 'home');
    die;
}
