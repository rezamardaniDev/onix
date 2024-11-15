<?php

$bot->sendChatAction($from_id, 'typing');
$response = $apiRequest->funnyService('joke');7

if (!$response) {
    $bot->sendMessage($from_id, 'پاسخی دریافت نشد', mrk: 'Markdown');
    die;
}

$botMessage = $response->result;

if ($text) {
    $bot->sendMessage($from_id, $botMessage, $jokeKeyboard);
} else {
    $bot->editMessage($from_id, $botMessage, $message_id, $jokeKeyboard);
}
die;