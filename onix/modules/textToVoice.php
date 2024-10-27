<?php

if ($text == '「 🎙 متن به ویس」'){
    if ($userLimits->text_to_voice > 1) {
        $bot->sendMessage($from_id, 'متن مورد نظر خود را وارد کنید: ', $backButton);
        $userCursor->setStep($from_id, 'text-voice');
    } else {
        $bot->sendMessage($from_id, "تعداد ریکوست های امروز شما تمام شد .");
    }
    die;
}
$bot->sendChatAction($from_id, 'upload_document');
$response = $apiRequest->textToVocie($text);
$rand = rand(124588, 854963);
$audioFile = "onix_{$rand}.mp3";
file_put_contents($audioFile, $response);
$userCursor->setLimit($from_id, 'text_to_voice', $userLimits->text_to_voice - 1);
$bot->sendAudio($from_id, "https://fara-it.ir/onix/{$audioFile}", 'فایل با صدای مرد', $mainKeyboard);
unlink($audioFile);
$userCursor->setStep($from_id, 'home');
die;