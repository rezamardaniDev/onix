<?php

$inlineKeyboard = [
    'inline_keyboard' => []
];
$result = $userCursor->getChannel('private');
$sample = [];

foreach ($result as $key => $value) {
    $status = $bot->getChatMember('@' . $value->username, $from_id);
    $counter = 1;
    if ($status->result->status == "left" || $status->result->status == "kicked") {
        $sample[] = [['text' => "کانال شماره ({$counter})", 'url' => "https://t.me/{$value->username}"]];
    }
}

if ($sample) {
    $text ="برای استفاده از امکانات ربات در کانال های زیر عضو شوید";
    $inlineKeyboard['inline_keyboard'] = $sample;
    $bot->sendMessage($chat_id, $text, message_id: $message_id, keyboard: json_encode($inlineKeyboard));
    die;
}