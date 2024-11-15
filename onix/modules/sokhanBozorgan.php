<?php

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->sokhan();

if (!$response) {
    $bot->sendMessage($from_id, 'پاسخی دریافت نشد', mrk: 'Markdown');
    die;
}

$botMessage = $response->result->text;

if ($text) {
    $bot->sendMessage($from_id, $botMessage, $sokhanKeyboard);
} else {
    $bot->editMessage($from_id, $botMessage, $message_id, $sokhanKeyboard);
}
die;