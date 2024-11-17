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
        [['text' => '🔙 بازگشت']]
    ]
]);

# -------------- hoshmand keyboard -------------- #

$hoshmandKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 🖼 عکس با هوش مصنوعی 」']],
        [['text' => '「 🎨 لوگو اسم 」'], ['text' => '「 🎧 جستجوی موزیک 」']],
        [['text' => '「 🎙 متن به ویس」'], ['text' => '「 🗣 مترجم متن 」']],
        [['text' => '🔙 بازگشت']]

    ]
]);

# -------------- keyboard for AI section -------------- #

$aiKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'GPT-3.5'], ['text' => 'GPT-4.o']],
        [['text' => '🔙 بازگشت']]
    ]
]);

# -------------- Admin panel keyboard -------------- #

$adminPanelKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '✍🏻 - پیام همگانی'], ['text' => '📊 - آمار ربات']],
        [['text' => '👥 - مدیریت کاربران'], ['text' => '⚙️ - تنظیمات']],
        [['text' => '📬 - فروارد همگانی'], ['text' => '📣 تنظیم کانال ها']],
        [['text' => '🔻 - حذف ادمین'], ['text' => '🔺 - افزودن ادمین ']],
        [['text' => '🔕 - حذف پاسخ سریع'], ['text' => '🔔 - افزودن پاسخ سریع']],
        [['text' => '🔙 بازگشت']]
    ]
]);

# -------------- Back button keyboard -------------- #

$backButton = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '🔙 بازگشت']]
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
        [['text' => '🔙 بازگشت']]
    ]
]);

# -------------- Keyboard for translate button -------------- #

$translateKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 🇮🇷 مترجم انگلیسی به فارسی 」']],
        [['text' => '「 🏴󠁧󠁢󠁥󠁮󠁧󠁿 مترجم فارسی به انگلیسی 」']],
        [['text' => '🔙 بازگشت']]
    ]
]);

# -------------- Keyboard for downloader section-------------- #

$downloaderKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 📻 دانلود ساندکلود 」'], ['text' => '「 ▶️ دانلود یوتوب 」']],
        [['text' => '「 🔮 دانلود اینستاگرام 」']],
        [['text' => '🔙 بازگشت']]
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
        [['text' => '🔙 بازگشت']]
    ]
]);

# -------------- samsung keyboard -------------- #

$samsungKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'سری A'], ['text' => 'سری S']],
        [['text' => 'سری Z'], ['text' => 'سری M']],
        [['text' => '🔙 بازگشت']]
    ]
]);

# -------------- apple keyboard -------------- #

$appleKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'Iphone'], ['text' => 'Ipad']],
        [['text' => '🔙 بازگشت']]
    ]
]);

# -------------- xiaomi keyboard -------------- #

$xiaomiKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'سری POCO'], ['text' => 'سری redmi']],
        [['text' => '🔙 بازگشت']]
    ]
]);

// $channelViewKeyboard = json_encode([
//     'inline_keyboard' => [
//         [['text' => '𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺 🦜', 'url' => 'https://t.me/OnyxAiTeam']]
//     ]
// ]);

$startChannelKeyboard = json_encode([
    'inline_keyboard' => [
        [['text' => '𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺 🦜', 'url' => 'https://t.me/OnyxAiTeam']],
        [['text' => 'عضویت در گروه پشتیبانی', 'url' => 'https://t.me/+lBKllVxIzmVmNmZk']]
    ]
]);

$backToAdmin = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '🔙 بازگشت به ادمین پنل']]
    ]
]);

# -------------- User section keyboard -------------- #

$usersSectionButton = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '🔎 - جستجوی کاربر']],
        [['text' => '🚫 - مسدود سازی کاربر'], ['text' => '❇️ - رفع مسدودیت کاربر']],
        [['text' => '🔙 بازگشت به ادمین پنل']]
    ]
]);

$sendToAllKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '🤝 -  پیام به گروه ها'], ['text' => '👥 -  پیام به کاربران']],
        [['text' => '🔙 بازگشت به ادمین پنل']]
    ]
]);

$forwardToAllKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '🤝 -  فروارد به گروه ها'], ['text' => '👥 -  فروارد به کاربران']],
        [['text' => '🔙 بازگشت به ادمین پنل']]
    ]
]);

$setChannelsButton = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'حذف اسپانسری ربات'], ['text' => 'افزودن اسپانسری ربات']],
        [['text' => 'حذف اسپانسری گروه'], ['text' => 'افزودن اسپانسری گروه']],
        [['text' => 'حذف کانال تبلیغاتی'], ['text' => 'افزودن کانال تبلیغاتی']],
        [['text' => '🔙 بازگشت به ادمین پنل']]
    ]
]);

$channelViewKeyboard = [
    'inline_keyboard' => []
];

$sample = [];
$result = $userCursor->getChannel('sponsor');

foreach ($result as $value) {
    $sample[] = [['text' =>  "کانال اسپانسر ({$value->username}) 📣", 'url' => "https://t.me/{$value->username}"]];
}

$channelViewKeyboard['inline_keyboard'] = $sample;
$channelViewKeyboard = json_encode($channelViewKeyboard);
