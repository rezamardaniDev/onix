<?php

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->funnyService('joke');
$botMessage = $response->result;

if ($text) {
    $bot->sendMessage($chat_id, $botMessage, $jokeKeyboard);
} else {
    $bot->editMessage($chat_id, $botMessage, $message_id, $jokeKeyboard);
}
die;