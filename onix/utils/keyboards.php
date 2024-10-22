<?php

# -------------- Main keyboard -------------- #

$mainKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'چت با هوش مصنوعی']],
        [['text' => 'خبر'], ['text' => 'نرخ ارز']],
        [['text' => 'دانلود ها']],
        [['text' => 'حساب کاربری'] , ['text' => 'نمی دونم']],
        [['text' => 'پنل ادمین']]
    ]
]);

# -------------- keyboard for AI section -------------- #

$aiKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'GPT 3'] , ['text' => 'GPT 4.O']],
    ]
]);

# -------------- Admin panel keyboard -------------- #
 
$adminPanelKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'همگانی'] , ['text' => 'آمار']],
        [['text' => 'کاربران']]
    ]
]);

# -------------- User section keyboard -------------- #

$userSectionKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'بلاک'] , ['text' => 'آنبلاک']],
        [['text' => 'جست وجو'] , ['text' => 'افزودن موجودی']]
    ]
]);
