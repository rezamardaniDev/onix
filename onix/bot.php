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

# -------------- text to voice button -------------- #

if ($text == '「 🎙 متن به ویس」' || $user->step == 'text-voice') {
    require 'modules/textToVoice.php';
}

# -------------- translator button -------------- #

require 'modules/translator.php';

# -------------- weather section -------------- #

if (preg_match('/^هوا/', $text)) {
    require 'modules/weather.php';
}

if ($text == '「 📥 دانلودر ها」') {
    $bot->sendMessage($from_id, 'لطفا یکی از گزینه های زیر را انتخاب کنید: ', $downloaderKeyboard);
    die;
}

if ($text == '「 📻 دانلود ساندکلود 」' || $user->step == 'get-sound-cloud') {
    require 'modules/soundCouldDl.php';
}

# -------------- phone price section -------------- #

if ($text == '「 📱 قیمت گوشی 」') {
    $bot->sendMessage($from_id, "لطفا یکی از مدل های زیر را انتخاب کنید یا اسم مدل مد نظر خود را وارد کنید : ", $phonePriceKeyboard);
    $userCursor->setStep($from_id, 'phoneSelection');
}

if (in_array($text , ["SAMSUNG" , "APPLE" , "XIAOMI"]) && $user->step == "phoneSelection"){
    $keyboard;
    switch($text){
        case "SAMSUNG":
            $keyboard = $samsungKeyboard;
            break;
        case "APPLE" :
            $keyboard = $appleKeyboard;
            break;
        case "XIAOMI":
            $keyboard = $xiaomiKeyboard;
            break;
        default:
            $keyboard = null;
    }
    $bot->sendMessage($from_id, "لطفا یکی از مدل های زیر را انتخاب کنید یا اسم مدل مد نظر خود را وارد کنید : ", $keyboard);
    $userCursor->setStep($from_id, 'choosePhone');
}

if ($user->step == "choosePhone") {
    $action = '';
    switch ($text) {
        case 'سری S':
            $action = 'Samsung Galaxy S';
            break;
        case 'سری A':
            $action = 'Samsung Galaxy A';
            break;
        case 'سری M':
            $action = 'Samsung Galaxy M';
            break;
        case 'سری Z':
            $action = 'Samsung Galaxy Z';
            break;
        case 'سری POCO':
            $action = 'poco';
            break;
        case 'سری redmi':
            $action = 'redmi';
            break;
        case 'NOKIA':
            $action = 'nokia';
            break;
        case 'Iphone':
            $action = 'Iphone';
            break;
        case 'Ipad':
            $action = 'Ipad';
            break;
        default:
            $action = "$text";
    }
    $response = $apiRequest->getPriceOfPhone($action);
    $bot->sendMessage($from_id, $response);
    die;
}
