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
require 'database/groupsMethods.php';
require 'utils/keyboards.php';
require 'database/oneApi.php';
require 'partial/botMessages.php';

# -------------- Create Objects -------------- #

$bot = new Bot(API_KEY);
$userCursor = new UserConnection();
$groupCursor = new GroupConnection();
$apiRequest = new OneApi(RAMZINE);


# -------------- Include variables -------------- #

require 'utils/variables.php';

# -------------- Main Codes -------------- #
if ($update) {
    require 'partial/updateMessage.php';
}

if (($text == '/start' || $text == 'بازگشت') && $type != "supergroup") {
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

# -------------- weather section -------------- #

if (preg_match('/^هوا/', $text) || $text == '「 🌦 آب و  هوا 」') {
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

if ($text == 'پنل ادمین' && $user->is_admin) {
    $bot->sendMessage($from_id, 'به پنل مدیریت خوش آمدید', $adminPanelKeyboard);
    $userCursor->setStep($from_id, 'admin-panel');
    die;
}

if ($text == 'پاسخ سریع') {
    $bot->sendMessage($from_id, 'لطفا کلمه مورد نظر را در خط اول و پاسخ آن را در خط دوم وارد کنید: ');
    $userCursor->setStep($from_id, 'add-force-message');
    die;
}

if ($user->step == 'add-force-message') {
    $cutter = explode("\n", $text);
    if (count($cutter) == 2) {
        $userCursor->addNewForceMessage($cutter);
        $bot->sendMessage($from_id, 'جمله و پاسخ شما ذخیره شد.', $mainKeyboard2);
        $userCursor->setStep($from_id, 'home');
    } else {
        $bot->sendMessage($from_id, 'مقادیر اشتباه است!');
    }
    die;
}

if ($text == 'حذف پاسخ سریع') {
    $bot->sendMessage($from_id, 'کلمه ای که میخواهید پاک شود را بده');
    $userCursor->setStep($from_id, 'delete-force-message');
    die;
}

if ($user->step ==  'delete-force-message') {
    $userCursor->deleteForceMessage($text);
    $bot->sendMessage($chat_id, 'کلمه حذف شد', message_id: $message_id);
    die;
}

# -------------- translator button -------------- #

require 'modules/translator.php';

# -------------- phone price section -------------- #

require 'modules/phonePrice.php';

# -------------- group command section -------------- #

require 'partial/groupCommands.php';
