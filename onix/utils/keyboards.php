<?php

// Main keyboard
$mainKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => '「 👨‍💻 چت با هوش مصنوعی 」']],
        [['text' => 'خبر'], ['text' => '「 💵 نرخ ارز 」']],
        [['text' => 'دانلود ها']],
        [['text' => 'حساب کاربری'] , ['text' => 'نمی دونم']],
        [['text' => 'پنل ادمین']]
    ]
]);

// keyboard for AI section 
$AiKeyboard = json_encode([
    'resize_keyboard' => true,
    'keyboard' => [
        [['text' => 'GPT 3'] , ['text' => 'GPT 4.O']],
    ]
]);