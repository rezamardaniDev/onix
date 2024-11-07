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

# -------------- Main Codes -------------- #

if (!$user->is_admin) {
    if ($type == 'supergroup') {

        $commands = ['انیکس', 'اونیکس', 'ارز', 'اوقات', 'جوک', 'سخن بزرگان', 'دانستنی', 'فال', 'راهنما', 'ترجمه به انگلیسی', 'ترجمه به فارسی'];
        foreach ($commands as $value) {
            if ((strpos($text, $value) === 0)) {
                require 'partial/forceJoin.php';
            }
        }
    } else {
        require 'partial/forceJoin.php';
    }
}

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

if ($user->is_admin && $text == "✍🏻 - فروارد همگانی") {
    $bot->sendMessage($from_id, 'لطفا یکی از گزینه های زیر را انتخاب کنید: ', $forwardToAllKeyboard);
    die;
}

if ($user->is_admin && $text == '🤝 -  فروارد همگانی به گروه ها') {
    $bot->sendMessage($from_id, 'پیام خود را برای ربات فروارد کنید :', $backToAdmin);
    $userCursor->setStep($from_id, 'forward_public_message_group');
    die;
}



if ($user->step ==  'forward_public_message_group') {
    $userCursor->setForwardMessage($from_id , $message_id , 'groups');
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای کاربران ارسال می شود", $adminPanelKeyboard);
}


if ($user->is_admin && $text == '👥 -  فروارد همگانی به کاربران') {
    $bot->sendMessage($from_id, 'پیام خود را برای ربات فروارد کنید :', $backToAdmin);
    $userCursor->setStep($from_id, 'forward_public_message_users');
    die;
}


if ($user->step ==  'forward_public_message_users') {
    $userCursor->setForwardMessage($from_id , $message_id , 'users');
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای کاربران ارسال می شود", $adminPanelKeyboard);
}