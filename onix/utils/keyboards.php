<?php

# -------------- Main keyboard -------------- #

$mainKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 👨‍💻 چت با هوش مصنوعی 」']],
        [['text' => '「 📡 اخبار روز 」'], ['text' => '「 💵 نرخ ارز و طلا 」']],
        [['text' => '「 📥 دانلودر ها」']],
        [['text' => '「 ✉️ فال حافظ 」'], ['text' => '「 ⁉️ دانستنی 」']],
        [['text' => '「 🤡 جوکستان 」'], ['text' => '「 🕌 اوقات شرعی 」']],
        [['text' => '「 📊 ارز دیجیتال 」']],
        [['text' => '「 👤 حساب کاربری 」'], ['text' => '「 🆘 راهنما 」']],
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
        [['text' => 'همگانی'], ['text' => 'آمار']],
        [['text' => 'کاربران'], ['text' => 'تنظیمات']],
        [['text' => 'کانال ها'], ['text' => 'نمی دانم']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- User section keyboard -------------- #

$userSectionKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'بلاک'], ['text' => 'آنبلاک']],
        [['text' => 'جست وجو'], ['text' => 'افزودن موجودی']],
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

$helpButton = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'چگونه ربات را به گروه اد کنم؟']],
        [['text' => 'چگونه داخل گروه از ربات استفاده کنم؟']],
        [['text' =>  'درخواست اسپانسری دارم؟']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- base for prices and inline keyboards -------------- #

$pricesKeyboard = [
    'inline_keyboard' => []
];
