<?php

if ($text == '「 📊 ارز دیجیتال 」') {
    $botMessage = $crypto_text;
    $bot->sendMessage($from_id, $botMessage, $backButton);
    die;
}
if (in_array($text, $crypto_list)) {
    $price = 1;
    $formatter[1] = $text;
} else {
    $formatter = explode(' ', $text, 2);
    $formatter[0] = $bot->convertFaToEn($formatter[0]);
    $price = $formatter[0];
}
# -------------- response for crypto button -------------- #

$bot->sendChatAction($chat_id, 'typing');
$bot->sendMessage($chat_id, 'سورس ربات درسته!');
$response = $apiRequest->crypto();
foreach ($response->result as $key => $value) {
    if (str_contains($value->name, $formatter[1])) {

        $dollar = floatval($value->usdt) * floatval($price);
        $rial = print_r(number_format(floatval($value->irr) * $price), true);
        $dayChange = $value->dayChange;

        $botMessage = "
┌💱 {$price} {$key} :
 ┊
 ├Dollar: \${$dollar}
 ┊
 ├IRT: {$rial} تومان
 ┊
 └Changes per day: {$dayChange}  🔺🔻";

        $bot->sendMessage($chat_id, $botMessage, message_id: $message_id, keyboard: $sponsorKeyboard);
        die;
    }
}
die;
