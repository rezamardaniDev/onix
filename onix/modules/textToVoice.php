<?php

if ($text == '「 🎙 متن به ویس」') {
    if ($userLimits->text_to_voice > 1) {
        $bot->sendMessage($from_id, 'متن مورد نظر خود را وارد کنید: ', $backButton);
        $userCursor->setStep($from_id, 'text-voice');
    } else {
        $bot->sendMessage($from_id, "تعداد ریکوست های امروز شما تمام شد .");
    }
    die;
} else {
    # -------------- get men voice  -------------- #

    $bot->sendChatAction($from_id, 'upload_document');
    $response = $apiRequest->textToVocieMan($text);
    $bot->sendAudio($from_id, $response, 'فایل با صدای مرد');

    # -------------- get women voice  -------------- #

    $bot->sendChatAction($from_id, 'upload_document');
    $response = $apiRequest->textToVocieWoMan($text);
    $bot->sendAudio($from_id, $response, 'فایل با صدای زن', $hoshmandKeyboard);

    # -------------- decrease voice limits  -------------- #

    $userCursor->setLimit($from_id, 'text_to_voice', $userLimits->text_to_voice - 1);
    $userCursor->setStep($from_id, 'home');
    die;
}
