<?php

if (preg_match('/^اوقات/', $text)) { {
        $text = explode(' ', $text, 2)[1];

        $bot->sendChatAction($chat_id, 'typing');
        $response = $apiRequest->oghatSharie($text);

        if ($response->status != 200) {
            $bot->sendMessage($chat,  'خطایی در جستجوی شهر مورد نظر رخ داد!', $mainKeyboard);
            $userCursor->setStep($chat, 'home');
            die;
        }

        require 'partial/oghatVariables.php';

        $botMessage = $shahr . $sob . $tloe . $zohr . $ghrob . $mghreb . $nimeShab;
        $bot->sendMessage($chat_id, $botMessage);
        die;
    }
}

if (preg_match('/^ترجمه به انگلیسی/', $text)) {
    $bot->sendChatAction($chat_id, 'typing');
    $sentence = substr($text, 30);
    $response = $apiRequest->translateToEn($sentence);
    $bot->sendMessage($chat_id, $response);
    die;
}

if (preg_match('/^ترجمه به فارسی/', $text)) {
    $bot->sendChatAction($chat_id, 'typing');
    $sentence = substr($text, 27);
    $response = $apiRequest->translateToFa($sentence);
    $bot->sendMessage($chat_id, $response);
    die;
}
