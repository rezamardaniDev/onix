<?php

$spector = explode(' ', $text);

if (count($spector) == 2) {
    $amount = $bot->convertFaToEn($spector[0]);
    $cryptoName = $spector[1];
} else {
    $amount = 1;
    $cryptoName = $spector[0];
}
$response = $apiRequest->arzDigital($cryptoItems[$cryptoName]);

if (!$response) {
    $bot->sendMessage($from_id, 'پاسخی دریافت نشد', mrk: 'Markdown');
    die;
}

$title = $response[0]->currency1->title;
$titleFa = $response[0]->currency1->title_fa;
if (count($spector) == 2) {
    $priceRial = number_format($amount * intval($response[0]->price)) . ' تومان';
} else {
    $priceRial = number_format(intval($response[0]->price)) . ' تومان';
}
$priceRial = number_format($amount * intval($response[0]->price)) . ' تومان';
$priceDollar = $response[1]->price  ?? $amount;
$change =  $response[0]->price_info->change;

$botMessage = "
┌<b>💱 {$amount} {$title} </b>
 ┊
 ├Dollar: \${$priceDollar} دلار
 ┊
 ├IRT: {$priceRial}
 ┊
 └Changes per day: {$change} 🔺🔻
";

$bot->sendMessage($chat_id, $botMessage, message_id: $message_id, keyboard:$channelViewKeyboard);
