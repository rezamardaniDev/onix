<?php

if ($text == '「 🕌 اوقات شرعی 」'){
    $bot->sendMessage($from_id, 'لطفا نام شهر مورد نظر خود را وارد کنید: ', $backButton);
    $userCursor->setStep($from_id, 'get-oghat');
    die;
}else{
    $bot->sendChatAction($chat_id, 'typing');
    $response = $apiRequest->oghatSharie($text);

    if ($response->status != 200) {
        $bot->sendMessage($from_id,  'خطایی در جستجوی شهر مورد نظر رخ داد!', $mainKeyboard);
        $userCursor->setStep($from_id, 'home');
        die;
    }

    require 'partial/oghatVariables.php';

    $botMessage = $shahr . $sob . $tloe . $zohr . $ghrob . $mghreb . $nimeShab . "برای جستجوی مجدد نام شهر را ارسال کنید";
    $bot->sendMessage($from_id, $botMessage, $backButton);
    die;
}