<?php

# -------------- Main keyboard -------------- #

$mainKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 👨‍💻 چت با هوش مصنوعی 」']],
        [['text' => '「 📡 اخبار روز 」'], ['text' => '「 💵 نرخ ارز و طلا 」']],
        [['text' => '「 📥 دانلودر ها」']],
        [['text' => '「 👤 حساب کاربری 」'], ['text' => '「 🆘 راهنما 」']],
        [['text' => '「 ✉️ فال حافظ 」']],
        [['text' => 'پنل ادمین']]
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
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'فال مجدد']],
        [['text' => 'بازگشت']]
    ]
]);

# -------------- base for prices and inline keyboards -------------- #

$pricesKeyboard = [
    'inline_keyboard' => []
];
