<?php

if ($text == '「 🎙 متن به ویس」') {
    if ($userLimits->text_to_voice > 1) {
        $bot->sendMessage($from_id, 'متن مورد نظر خود را وارد کنید: ', $backButton);
        $userCursor->setStep($from_id, 'text-voice');
    } else {
        $bot->sendMessage($from_id, "تعداد ریکوست های امروز شما تمام شد .");
    }
    die;
}else{
    # -------------- get men voice  -------------- #
    
    $bot->sendChatAction($from_id, 'upload_document');
    $response = $apiRequest->textToVocieMan($text);
    $rand = rand(124588, 854963);
    $audioFile = "onix_{$rand}.mp3";
    file_put_contents($audioFile, $response);
    $bot->sendAudio($from_id, "https://fara-it.ir/onix/{$audioFile}", 'فایل با صدای مرد');
    unlink($audioFile);
    
    # -------------- get women voice  -------------- #
    
    $bot->sendChatAction($from_id, 'upload_document');
    $response = $apiRequest->textToVocieWoMan($text);
    $rand = rand(124588, 854963);
    $audioFile = "onix_{$rand}.mp3";
    file_put_contents($audioFile, $response);
    $bot->sendAudio($from_id, "https://fara-it.ir/onix/{$audioFile}", 'فایل با صدای زن', $mainKeyboard);
    unlink($audioFile);
    
    # -------------- decrease voice limits  -------------- #
    
    $userCursor->setLimit($from_id, 'text_to_voice', $userLimits->text_to_voice - 1);
    $userCursor->setStep($from_id, 'home');
    die;
}

