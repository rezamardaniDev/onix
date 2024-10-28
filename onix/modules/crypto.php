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

    if (preg_match('/^[1-9]\d*/', $formatter[0]) && in_array($formatter[1], $crypto_list)) {
        $price = $formatter[0];
    }
}
# -------------- response for crypto button -------------- #

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->crypto();
foreach ($response->result as $key => $value) {
    if (str_contains($value->name, $formatter[1])) {

        $dollar = floatval($value->usdt) * floatval($price);
        $rial = print_r(number_format(floatval($value->irr) * floatval($price)), true);
        $dayChange = $value->dayChange;

        $botMessage = "
┌💱 {$price} {$key} :
 ┊
 ├Dollar: \${$dollar}
 ┊
 ├IRT: {$rial} تومان
 ┊
 └Changes per day: {$dayChange}  🔺🔻";

        $bot->sendMessage($chat_id, $botMessage, message_id: $message_id);
        die;
    }
}
die;
