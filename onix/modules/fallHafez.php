<?php

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->funnyService('hafez');

if (!$response->result) {
    $bot->sendMessage($from_id, 'پاسخی دریافت نشد', mrk: 'Markdown');
    die;
}

$botMessage = '<b>' . "{$response->result->TITLE}" . '</b>' . "\n\n {$response->result->RHYME}\n\n {$response->result->MEANING}\n\nشماره: {$response->result->SHOMARE}";

if ($text) {
    $bot->sendMessage($from_id, $botMessage, $falKeyboard);
} else {
    $bot->editMessage($from_id, $botMessage, $message_id, $falKeyboard);
}
die;