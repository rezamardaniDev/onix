<?php

# -------------- Main keyboard -------------- #

$mainKeyboard1 = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 👨‍💻 چت با هوش مصنوعی 」']],
        [['text' => '「 📡 ابزار کاربردی 」'], ['text' => '「 💵 ابزار هوشمند 」']],
        [['text' => '「 📥 دانلودر ها」']],
        [['text' => '「 👤 حساب کاربری 」'], ['text' => '「 🆘 راهنما 」']]

    ]
]);

$mainKeyboard2 = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 👨‍💻 چت با هوش مصنوعی 」']],
        [['text' => '「 📡 ابزار کاربردی 」'], ['text' => '「 💵 ابزار هوشمند 」']],
        [['text' => '「 📥 دانلودر ها」']],
        [['text' => '「 👤 حساب کاربری 」'], ['text' => '「 🆘 راهنما 」']],
        [['text' => 'پنل ادمین']],

    ]
]);

# -------------- karbordi keyboard -------------- #


$karbordiKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 🤡 جوکستان 」'], ['text' => '「 🕌 اوقات شرعی 」']],
        [['text' => '「 📡 اخبار روز 」'], ['text' => '「 ✉️ فال حافظ 」']],
        [['text' => '「 💵 نرخ ارز و طلا 」'],  ['text' => '「 📊 ارز دیجیتال 」']],
        [['text' => '「 ⁉️ دانستنی 」'], ['text' => '「 📜 سخن بزرگان 」']],
        [['text' => '「 📱 قیمت گوشی 」'], ['text' => '「 🌦 آب و  هوا 」']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- hoshmand keyboard -------------- #

$hoshmandKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 🖼 عکس با هوش مصنوعی 」']],
        [['text' => '「 🎨 لوگو اسم 」'], ['text' => '「 🎧 جستجوی موزیک 」']],
        [['text' => '「 🎙 متن به ویس」'], ['text' => '「 🗣 مترجم متن 」']],
        [['text' => 'بازگشت']]

    ]
]);

# -------------- keyboard for AI section -------------- #

$aiKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'GPT-3.5'], ['text' => 'GPT-4.o']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- Admin panel keyboard -------------- #

$adminPanelKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'پیام همگانی'], ['text' => 'آمار']],
        [['text' => 'کاربران'], ['text' => 'تنظیمات']],
        [['text' => 'کانال ها']],
        [['text' => 'حذف ادمین'], ['text' => 'افزودن ادمین']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- Back button keyboard -------------- #

$backButton = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'بازگشت']]
    ]
]);

# -------------- Keyboard for random fal -------------- #

$falKeyboard = json_encode([
    'inline_keyboard' => [
        [['text' => '🔄 | فال مجدد', 'callback_data' => 'fal']]
    ]
]);

# -------------- Keyboard for random danestani -------------- #

$danestaniKeyboard = json_encode([
    'inline_keyboard' => [
        [['text' => '➡️ | بعدی', 'callback_data' => 'danestani']]
    ]
]);

# -------------- Keyboard for random joke -------------- #

$jokeKeyboard = json_encode([
    'inline_keyboard' => [
        [['text' => '➡️ | بعدی', 'callback_data' => 'joke']]
    ]
]);

# -------------- Keyboard for sokhan Bozorgan -------------- #

$sokhanKeyboard = json_encode([
    'inline_keyboard' => [
        [['text' => '➡️ | بعدی', 'callback_data' => 'sokhan']]
    ]
]);

# -------------- Keyboard for help button -------------- #

$helpButton = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'چگونه ربات را به گروه اد کنم؟']],
        [['text' => 'چگونه داخل گروه از ربات استفاده کنم؟']],
        [['text' =>  'درخواست اسپانسری دارم؟']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- Keyboard for translate button -------------- #

$translateKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 🇮🇷 مترجم انگلیسی به فارسی 」']],
        [['text' => '「 🏴󠁧󠁢󠁥󠁮󠁧󠁿 مترجم فارسی به انگلیسی 」']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- Keyboard for downloader section-------------- #

$downloaderKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 📻 دانلود ساندکلود 」'], ['text' => '「 ▶️ دانلود یوتوب 」']],
        [['text' => '「 🔮 دانلود اینستاگرام 」']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- base for prices and inline keyboards -------------- #

$pricesKeyboard = [
    'inline_keyboard' => []
];

# -------------- phone price keyboard -------------- #

$phonePriceKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'SAMSUNG'], ['text' => 'APPLE']],
        [['text' => 'NOKIA'], ['text' => 'XIAOMI']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- samsung keyboard -------------- #

$samsungKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'سری A'], ['text' => 'سری S']],
        [['text' => 'سری Z'], ['text' => 'سری M']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- apple keyboard -------------- #

$appleKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'Iphone'], ['text' => 'Ipad']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- xiaomi keyboard -------------- #

$xiaomiKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'سری POCO'], ['text' => 'سری redmi']],
        [['text' => 'بازگشت']]
    ]
]);

$channelViewKeyboard = json_encode([
    'inline_keyboard' => [
        [['text' => '𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺 🦜', 'url' => 'https://t.me/OnyxAiTeam']]
    ]
]);

$startChannelKeyboard = json_encode([
    'inline_keyboard' => [
        [['text' => '𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺 🦜', 'url' => 'https://t.me/OnyxAiTeam']],
        [['text' => 'عضویت در گروه پشتیبانی', 'url' => 'https://t.me/+lBKllVxIzmVmNmZk']]
    ]
]);

$backToAdmin = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'بازگشت به ادمین پنل']]
    ]
]);

# -------------- User section keyboard -------------- #

$usersSectionButton = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'جستجوی کاربر']],
        [['text' => 'مسدود سازی کاربر'], ['text' => 'رفع مسدودیت کاربر']],
        [['text' => 'بازگشت به ادمین پنل']]
    ]
]);

$sendToAllKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => ' پیام همگانی گروه ها'], ['text' => 'پیام همگانی کاربران']],
        [['text' => 'بازگشت به ادمین پنل']]
    ]
]);


$setChannelsButton = $sendToAllKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'افزودن جوین اجباری گپ'], ['text' => 'حذف جوین اجباری گپ']],
        [['text' => 'افزودن جوین اجباری ربات'], ['text' => 'حذف جوین اجباری ربات']],
        [['text' => 'افزودن دکمه تبلیغاتی'], ['text' => 'حذف دکمه تبلیغاتی']],
        [['text' => 'بازگشت به ادمین پنل']]
    ]
]);
