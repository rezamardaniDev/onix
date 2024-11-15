<?php

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->getNews();

if (!$response) {
    $bot->sendMessage($from_id, 'پاسخی دریافت نشد', mrk: 'Markdown');
    die;
}
$bot->sendMessage($from_id, $response);