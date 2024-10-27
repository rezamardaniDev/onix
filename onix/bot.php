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

if ($text == '「 💵 نرخ ارز و طلا 」' || $text == 'نرخ ارز') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->getCurrency();
    require 'partial/currencyPrice.php';
    $bot->sendMessage($chat_id, "🔴 نرخ بازار ارز به صورت لحظه ای به شرح زیر می باشد:", json_encode($pricesKeyboard));
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
        $userCursor->setStep($from_id, 'home');
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

if ($text == '「 🎨 لوگو اسم 」') {
    if($userLimits->logo_limit <= 0){
        $bot->sendMessage($from_id , "تعداد ریکوست های امروز شما تمام شد ." , $mainKeyboard);
        die;
    }
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, 'اسم مورد نظر خود را برای ساخت لوگو به انگلیسی وارد کنید: ', $backButton);
    $userCursor->setStep($from_id, 'cr-logo');
    die;
}

if ($user->step == 'cr-logo') {
    $bot->sendMessage($from_id, 'لطفا اندکی صبر کنید...');
    $response = $apiRequest->makeLogo($text);
    $bot->sendChatAction($from_id, 'upload_photo');
    $bot->sendPhoto($from_id, $response, 'لوگو اسم شما آماده شد!', $mainKeyboard);
    $userCursor->setStep($from_id, 'home');
    die;
}

if ($text == '「 🖼 عکس با هوش مصنوعی 」') {
    if($userLimits->image_limit <= 0){
        $bot->sendMessage($from_id , "تعداد ریکوست های امروز شما تمام شد ." , $mainKeyboard);
        die;
    }
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, 'متن مورد نظر خود را برای ساخت تصویر وارد کنید: ', $backButton);
    $userCursor->setStep($from_id, 'cr-photo');
    die;
}

if ($user->step == 'cr-photo') {
    $bot->sendMessage($from_id, 'لطفا اندکی صبر کنید...');
    $text = $apiRequest->translateToEn($text);
    $response = $apiRequest->aiPhoto($text);
    $bot->sendChatAction($from_id, 'upload_photo');
    $bot->sendPhoto($from_id, $response, 'تصویر شما آماده شد', $mainKeyboard);
    $userCursor->setLimit($from_id , 'image_limit' , $userLimits->image_limit - 1);
    $userCursor->setStep($from_id, 'home');
    die;
}

if ($text == '「 📜 سخن بزرگان 」' || $data == 'sokhan') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->sokhan();
    $botMessage = $response->result->text;

    if ($text) {
        $bot->sendMessage($from_id, $botMessage, $sokhanKeyboard);
    } else {
        $bot->editMessage($from_id, $botMessage, $message_id, $sokhanKeyboard);
    }
    die;
}

if ($text == '「 🎧 جستجوی موزیک 」') {
    if($userLimits->search_music <= 0){
        $bot->sendMessage($from_id , "تعداد ریکوست های امروز شما تمام شد ." , $mainKeyboard);
        die;
    }
    $bot->sendMessage($from_id, "لطفا نام موزیک  مورد نظر تو ارسال کن: \n\nمثال:\nعاشق دل شکسته معین\nکجای این شهر", $backButton);
    $userCursor->setStep($from_id, 'get-music');
    die;
}

if ($user->step == 'get-music') {
    if($userLimits->search_music <= 0){
        $bot->sendMessage($from_id , "تعداد ریکوست های امروز شما تمام شد ." , $mainKeyboard);
        die;
    }
    $bot->sendMessage($from_id, 'لطفا اندکی صبر کنید...');
    $response = $apiRequest->radioJavan($text)->result->top[0];
    if (empty($response)) {
        $bot->sendMessage($from_id, 'موزیک مورد نظر یافت نشد');
        die;
    }

    $link = $response->link;
    $artist = $response->artist;
    $song_name = $response->song;

    $bot->sendChatAction($from_id, 'upload_document');
    $bot->sendAudio($from_id, $link, "{$artist} - {$song_name}", $mainKeyboard);
    $userCursor->setLimit($from_id , 'search_music' , $userLimits->search_music - 1);
    $userCursor->setStep($from_id, 'home');
    die;
}

if ($text == 'متن به ویس') {
    if($userLimits->text_to_voice > 1){
        $bot->sendMessage($from_id, 'متن مورد نظر خود را وارد کنید: ');
        $userCursor->setStep($from_id, 'text-voice');
    }else{
        $bot->sendMessage($from_id , "تعداد ریکوست های امروز شما تمام شد ." , $mainKeyboard);
    }
    die;
}

if ($user->step == 'text-voice') {
    $response  = $apiRequest->textToVocie($text);
    $bot->sendChatAction($from_id, 'sending music');
    $userCursor->setLimit($from_id , 'text_to_voice' , $userLimits->text_to_voice - 1);
    $oggFile = 'tts.ogg';
    file_put_contents($oggFile, file_get_contents($response));

    $bot->sendAudio($from_id, 'tts.ogg', 'با صدای مرد', $mainKeyboard);
    $userCursor->setStep($from_id, 'home');
    die;
}
