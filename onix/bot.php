<?php

# -------------- Display Error -------------- #

error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Tehran");

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
    require 'modules/startBot.php';
}

if ($text == '「 📡 ابزار کاربردی 」') {
    $bot->sendMessage($from_id, "یکی از ابزار های زیر را انتخاب کنید ", $karbordiKeyboard);
    die;
}

if ($text == '「 💵 ابزار هوشمند 」') {
    $bot->sendMessage($from_id, "یکی از ابزار های زیر را انتخاب کنید ", $hoshmandKeyboard);
    die;
}

# -------------- include ai section -------------- #

include 'modules/chatBotSection.php';

# -------------- include news section -------------- #

if ($text == '「 📡 اخبار روز 」') {
    require 'modules/getNews.php';
}

# -------------- prices of gold and money -------------- #

if ($text == '「 💵 نرخ ارز و طلا 」' || $text == 'نرخ ارز') {
    require 'modules/goldPrice.php';
}

# -------------- get hafez fal -------------- #

if ($text == '「 ✉️ فال حافظ 」' || $data == 'fal') {
    require 'modules/fallHafez.php';
}

# -------------- get danestani -------------- #

if ($text == '「 ⁉️ دانستنی 」' || $data == 'danestani') {
    require 'modules/danestani.php';
}

# -------------- get random joke -------------- #

if ($text == '「 🤡 جوکستان 」' || $data == 'joke') {
    require 'modules/jokestan.php';
}

# -------------- get city oghat -------------- #

if ($text == '「 🕌 اوقات شرعی 」' || $user->step == 'get-oghat') {
    require 'modules/oghatSharie.php';
}

# -------------- get crypto price -------------- #

if ($text == '「 📊 ارز دیجیتال 」' || in_array($text, $crypto_list) || in_array(explode(' ', $text, 2)[1], $crypto_list)) {
    require 'modules/crypto.php';
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

# -------------- name logo button -------------- #

if ($text == '「 🎨 لوگو اسم 」' || $user->step == 'cr-logo') {
    require 'modules/logoCreation.php';
}

# -------------- AI image creation button -------------- #

if ($text == '「 🖼 عکس با هوش مصنوعی 」' || $user->step == 'cr-photo') {
    require 'modules/imageCreation.php';
}

# -------------- sokhan bozorgan button -------------- #

if ($text == '「 📜 سخن بزرگان 」' || $data == 'sokhan') {
    require 'modules/sokhanBozorgan.php';
}

# -------------- search music button -------------- #

if ($text == '「 🎧 جستجوی موزیک 」' || $user->step == 'get-music') {
    require 'modules/musicSearch.php';
}

# -------------- voice to text button -------------- #

if ($text == '「 🎙 متن به ویس」' || $user->step == 'text-voice') {
    require 'modules/textToVoice.php';
}

if ($text == '「 🗣 مترجم متن 」') {
    $bot->sendMessage($from_id, 'لطفا نوع ترجمه را انتخاب کنید: ', $translateKeyboard);
    $userCursor->setStep($from_id, 'translator');
    die;
}

if ($user->step == 'translator') {
    if ($text == '「 🇮🇷 مترجم انگلیسی به فارسی 」') {
        $bot->sendMessage($from_id, 'لطفا متن انگلیسی خود را وارد کنید: ', $backButton);
        $userCursor->setStep($from_id, 'translate-en-fa');
        die;
    }

    if ($text == '「 🏴󠁧󠁢󠁥󠁮󠁧󠁿 مترجم فارسی به انگلیسی 」') {
        $bot->sendMessage($from_id, 'لطفا متن فارسی خود را وارد کنید: ', $backButton);
        $userCursor->setStep($from_id, 'translate-fa-en');
        die;
    }
}

if (preg_match('/^translate/', $user->step)) {
    if ($user->step == 'translate-en-fa') {
        $response = $apiRequest->translateToFa($text);
        $bot->sendMessage($from_id, $response, $translateKeyboard);
        $userCursor->setStep($from_id, 'translator');
        die;
    }

    if ($user->step == 'translate-fa-en') {
        $response = $apiRequest->translateToEn($text);
        $bot->sendMessage($from_id, $response, $translateKeyboard);
        $userCursor->setStep($from_id, 'translator');
        die;
    }
}

if (preg_match('/^هوا/', $text)) {
    $response = $apiRequest->getWhater(explode(' ', $text, 2)[1]);

    $country      = $response->result->country;
    $state        = $response->result->state;
    $weather_cond = $response->result->weather_conditions;
    $degree       = $response->result->degree;
    $speed        = $response->result->speed;
    $humidity     = $response->result->humidity;

    $botMessage = "
🌎| کشور: $country
📍| استان: $state
☁️| وضعیت هوا: $weather_cond
❄️| دمای هوا️: $degree
🌪️| سرعت وزش باد️: $speed
🚿| رطوبت هوا️: $humidity
    ";

    $bot->sendMessage($from_id, $botMessage);
    die;
}
