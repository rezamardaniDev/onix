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
    $response = $apiRequest->aiPhoto($text);

    if (!$response) {
        $bot->sendMessage($from_id, 'پاسخی دریافت نشد', mrk: 'Markdown');
        die;
    }

    $bot->sendChatAction($from_id, 'upload_photo');
    $bot->deleteMessages($from_id, $message_id + 1);

    foreach ($response as $photo) {
        $bot->sendPhoto($from_id, $photo, 'تصویر شما آماده شد' . "\n\n<b>🦜 Download by @OnyxAiRoBot</b>", $hoshmandKeyboard);
    }

    $userCursor->setLimit($from_id, 'image_limit', $userLimits->image_limit - 1);
    $userCursor->setStep($from_id, 'home');
    die;
}
