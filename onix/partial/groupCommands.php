<?php

if (preg_match('/^اوقات/', $text)) { {
        $text = explode(' ', $text, 2)[1];

        $bot->sendChatAction($chat_id, 'typing');
        $response = $apiRequest->oghatSharie($text);

        if ($response->status != 200) {
            $bot->sendMessage($chat_id,  'خطایی در جستجوی شهر مورد نظر رخ داد!',  message_id: $message_id);
            $userCursor->setStep($chat_id, 'home');
            die;
        }

        require 'partial/oghatVariables.php';

        $botMessage = $shahr . $sob . $tloe . $zohr . $ghrob . $mghreb . $nimeShab;
        $bot->sendMessage($chat_id, $botMessage,  message_id: $message_id, keyboard:$channelViewKeyboard);
        die;
    }
}

if (preg_match('/^ترجمه به انگلیسی/', $text)) {
    $bot->sendChatAction($chat_id, 'typing');
    $sentence = substr($text, 30);
    $response = $apiRequest->translateToEn($sentence);
    $bot->sendMessage($chat_id, $response,  message_id: $message_id, keyboard:$channelViewKeyboard);
    die;
}

if (preg_match('/^ترجمه به فارسی/', $text)) {
    $bot->sendChatAction($chat_id, 'typing');
    $sentence = substr($text, 27);
    $response = $apiRequest->translateToFa($sentence);
    $bot->sendMessage($chat_id, $response, message_id: $message_id, keyboard:$channelViewKeyboard);
    die;
}

if ($text == 'سخن بزرگان') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->sokhan();
    $botMessage = $response->result->text;
    $bot->sendMessage($chat_id, $botMessage, message_id: $message_id, keyboard:$channelViewKeyboard);
    die;
}

if ($text == 'دانستنی') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->funnyService('danestani');
    $botMessage = $response->result->Content;
    $bot->sendMessage($chat_id, $botMessage, message_id: $message_id, keyboard:$channelViewKeyboard);
    die;
}

if ($text == 'جوک') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->funnyService('joke');
    $botMessage = $response->result;
    $bot->sendMessage($chat_id, $botMessage, message_id: $message_id, keyboard:$channelViewKeyboard);
    die;
}

if ($text == 'فال') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->funnyService('hafez');
    $botMessage = '<b>' . "{$response->result->TITLE}" . '</b>' . "\n\n {$response->result->RHYME}\n\n {$response->result->MEANING}\n\nشماره: {$response->result->SHOMARE}";
    $bot->sendMessage($chat_id, $botMessage, message_id: $message_id, keyboard:$channelViewKeyboard);
    die;
}

if ($text == 'ارز') {
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->getCurrency();
    require 'partial/currencyPrice.php';
    $bot->sendMessage($chat_id, "🔴 نرخ بازار ارز به صورت لحظه ای به شرح زیر می باشد:", json_encode($pricesKeyboard), message_id: $message_id);
    die;
}


if ($text == 'راهنما') {
    $bot->sendMessage($chat_id, $helper_text, message_id: $message_id, keyboard: json_encode([
        'inline_keyboard' => [
            [['text' =>  '+ افزودن ربات به گروه +', 'url' => 'https://telegram.me/onixToolsBot?startgroup=start']],
            [['text' => '𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺 🦜', 'url' => 'https://t.me/OnyxAiTeam']],
            [['text' => 'بستن راهنما', 'callback_data' => "del_" . ($message_id + 1)]]
        ]
    ]));
    die;
}
 