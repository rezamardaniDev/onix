<?php

# -------------- response for crypto button -------------- #

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->crypto();
foreach ($response->result as $key => $value) {
    if (str_contains($value->name, $formatter[1])) {
        $dollar = floatval($value->usdt) * floatval($price);
        $irr = print_r(number_format(floatval($value->irr) * floatval($price)), true);
        $botMessage = "
┌ {$price} {$key} :
┊
├Dollar: \${$dollar}
┊
└IRT: {$irr} تومان";

        $bot->sendMessage($chat_id, $botMessage);
        die;
    }
}
