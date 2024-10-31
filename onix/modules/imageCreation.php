<?php

if ($text == '「 🖼 عکس با هوش مصنوعی 」') {
    if ($userLimits->image_limit <= 0) {
        $bot->sendMessage($from_id, "تعداد ریکوست های امروز شما تمام شد .", $hoshmandKeyboard);
        die;
    }
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, 'متن مورد نظر خود را برای ساخت تصویر وارد کنید: ', $backButton);
    $userCursor->setStep($from_id, 'cr-photo');
    die;
} else {
    $bot->sendMessage($from_id, 'لطفا اندکی صبر کنید...');
    $text = $apiRequest->translateToEn($text);
    $response = $apiRequest->aiPhoto($text);
    $bot->sendChatAction($from_id, 'upload_photo');
    $bot->sendPhoto($from_id, $response, 'تصویر شما آماده شد', $hoshmandKeyboard);
    $userCursor->setLimit($from_id, 'image_limit', $userLimits->image_limit - 1);
    $userCursor->setStep($from_id, 'home');
    die;
}
