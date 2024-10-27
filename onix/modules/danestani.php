<?php

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->funnyService('danestani');
$botMessage = $response->result->Content;

if ($text) {
    $bot->sendMessage($from_id, $botMessage, $danestaniKeyboard);
} else {
    $bot->editMessage($from_id, $botMessage, $message_id, $danestaniKeyboard);
}
die;