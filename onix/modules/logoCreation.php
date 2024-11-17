<?php

if ($text == '「 🎨 لوگو اسم 」') {
    if ($userLimits->logo_limit <= 0) {
        $bot->sendMessage($from_id, "تعداد ریکوست های امروز شما تمام شد .", $hoshmandKeyboard);
        die;
    }
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, 'اسم مورد نظر خود را برای ساخت لوگو به انگلیسی وارد کنید: ', $backButton);
    $userCursor->setStep($from_id, 'cr-logo');
    die;
} else {
    $bot->sendMessage($from_id, 'لطفا اندکی صبر کنید...');
    $response = $apiRequest->makeLogo($text);
    if ($response) {
        $bot->sendChatAction($from_id, 'upload_photo');
        $bot->deleteMessages($from_id, $message_id + 1);
        $bot->sendPhoto($from_id, $response, 'لوگو اسم شما آماده شد!'  . "\n\n<b>🦜 Download by @OnyxAiRoBot</b>", $hoshmandKeyboard);
        
        $userCursor->setLimit($from_id, 'logo_limit', $userLimits->logo_limit - 1);
        $userCursor->setStep($from_id, 'home');
    } else {
        $bot->sendMessage($from_id, 'پاسخی دریافت نشد', mrk: 'Markdown');
    }
    die;
}
