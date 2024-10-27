<?php

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->getCurrency();
require 'partial/currencyPrice.php';
$bot->sendMessage($chat_id, "🔴 نرخ بازار ارز به صورت لحظه ای به شرح زیر می باشد:", json_encode($pricesKeyboard));
die;