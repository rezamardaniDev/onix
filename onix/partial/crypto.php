<?php

if (preg_match('/^[1-9]\d*/', $price)) {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->crypto();
    foreach ($response->result as $key => $value) {
        if ($formatter[1] == $value->name) {

            $dollar = intval($value->usdt) * intval($price);
            $irr = print_r(intVal($value->irr) * intVal($price), true);
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
}
