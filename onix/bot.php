<?php

# -------------- Display Error -------------- #

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 0);

date_default_timezone_set("Asia/Tehran");

# -------------- Get Update From Telegram -------------- #

$update = json_decode(file_get_contents("php://input"));

# -------------- Include Essential Module -------------- #

require 'config/config.php';
require 'utils/methods.php';
require 'database/connector.php';
require 'database/usersMethods.php';
require 'database/groupsMethods.php';
require 'database/oneApi.php';
require 'partial/botMessages.php';

# -------------- Create Objects -------------- #

$bot = new Bot(API_KEY);
$userCursor = new UserConnection();
$groupCursor = new GroupConnection();
$apiRequest = new OneApi(RAMZINE);


# -------------- Include variables -------------- #

require 'utils/keyboards.php';
require 'utils/variables.php';
require 'partial/security.php';

# -------------- Main Codes -------------- #
if ($update) {
    require 'partial/updateMessage.php';
}

if (($text == '/start' || $text == '🔙 بازگشت') && $type != "supergroup") {
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

if ($text == '「 💵 نرخ ارز و طلا 」') {
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
if ($text == '「 📊 ارز دیجیتال 」') {
    $bot->sendMessage($from_id, $crypto_text, $backButton);
    die;
}

if (array_key_exists(explode(' ', $text)[0], $cryptoItems) || array_key_exists(explode(' ', $text)[1], $cryptoItems)) {
    $bot->sendChatAction($chat_id, 'typing');
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

# -------------- weather section -------------- #

if (strpos($text, 'هوا') === 0 || $text === '「 🌦 آب و  هوا 」') {
    require 'modules/weather.php';
}

# -------------- downloader section -------------- #

if ($text == '「 📥 دانلودر ها」') {
    $bot->sendMessage($from_id, 'لطفا یکی از گزینه های زیر را انتخاب کنید: ', $downloaderKeyboard);
    die;
}

# -------------- soundcloud downloader -------------- #

if ($text == '「 📻 دانلود ساندکلود 」' || $user->step == 'get-sound-cloud') {
    require 'modules/soundCouldDl.php';
}

# -------------- youtube downloader -------------- #

if ($text == '「 ▶️ دانلود یوتوب 」' || $user->step == 'yt-dl') {
    require 'modules/youtubeDl.php';
}

# -------------- instagram downloader -------------- #

if ($text == '「 🔮 دانلود اینستاگرام 」' || $user->step == 'insta') {
    require 'modules/instagramDl.php';
}

# -------------- translator button -------------- #

require 'modules/translator.php';

# -------------- phone price section -------------- #

require 'modules/phonePrice.php';

# -------------- group command section -------------- #

require 'partial/groupCommands.php';

# -------------- admin panel section -------------- #

require 'modules/adminPanel.php';

if (preg_match('/^اتوبوس/', $text)) {
    $specter = explode("\n", $text);
    $day = str_replace('/', '-', $specter[3]);
    $bot->sendMessage($chat_id, 'درحال جستجو تمام اتوبوس ها ...', message_id: $message_id);
    $response = $apiRequest->reserveBus($day, $specter[1], $specter[2]);

    if (!$response) {
        $bot->sendMessage($chat_id, 'اتوبوسی یافت نشد!', message_id: $message_id);
        die;
    }

    $bot_message = "اتوبوس های یافت شده در تاریخ انتخابی از {$specter[1]} به {$specter[2]} : \n";
    for ($i = 0; $i < min(8, count($response)); $i++) {
        $price = number_format($bus->price / 10);
        $bus = $response[$i];
        $bot->sendChatAction($chat_id, 'typing');
        $bot->deleteMessages($chat_id, $message_id + 1);
        $bot_message .= "
-- -- -- --
🏢 - شرکت: {$bus->company->name}  
🚌 - نوع اتوبوس: {$bus->busType}   
💰 - قیمت بلیط: {$price} تومان
⏰ - زمان حرکت: {$bus->departureTime}   
🪑 - ظرفیت خالی: {$bus->availableSeats} نفر
        ";
    }
    $bot_message .= "\n\n- اطلاعات فوق از سامانه سفر 724 دریافت شده است.";
    $bot->sendChatAction($chat_id, 'typing');
    $bot->sendMessage($chat_id, $bot_message, message_id: $message_id);
    die;
}
