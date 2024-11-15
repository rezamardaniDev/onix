<?php

$action = explode(" ", $text, 2);
if ($type == "supergroup" && ($action[0] == "اونیکس" || $action[0] == "انیکس")) {
    $bot->sendChatAction($chat_id, 'typing');
    $status = explode(' ', $action[1]);
    $section = '';

    switch (end($status)) {
        case '!':
            $section = 'با حالت خشم و ایموجی ';
            break;
        case '#':
            $section = 'با حالت ملایم و ایموجی ';
            break;
        default:
            $section = '';
    }

    $action[1] .= $section;
    $chatResponse = $apiRequest->sendTextToGpt($action[1], 'gpt-3');
    $bot->sendMessage($chat_id, $chatResponse, mrk: 'Markdown', message_id: $message_id, keyboard: $channelViewKeyboard);
    die;
}

# -------------- response for ChatBot button -------------- #

if ($text == '「 👨‍💻 چت با هوش مصنوعی 」') {
    $bot->sendMessage($from_id, 'لطفا یکی از نسخه های زیر را انتخاب کنید: ', $aiKeyboard);
    $userCursor->setStep($from_id, 'ai-select-category');
    die;
}

# -------------- change the AI type in database -------------- #

if ($user->step == 'ai-select-category') {
    if ($text == 'GPT-3.5') {
        if (!$userLimits->gpt_3_limit >= 1) {
            $bot->sendMessage($from_id, 'شما اعتبار کافی برای این بخش را ندارید.');
            die;
        }
        $userCursor->setAiType($from_id, 'gpt-3');
    } elseif ($text == 'GPT-4.o') {
        if (!$userLimits->gpt_4_limit >= 1) {
            $bot->sendMessage($from_id, 'شما اعتبار کافی برای این بخش را ندارید.');
            die;
        }
        $userCursor->setAiType($from_id, 'gpt-4');
    } else {
        die;
    }
    $bot->sendMessage($from_id, "ورژن شما انتخاب شد، هم اکنون میتوانید چت کنید\n\n اگر در آخر پاسخ خود یکی از علامت های زیر را بگذارید پاسخ متفاوت خواهد بود.\n\n! برای حالت خشن\n# برای حالت ملایم\n\nبرای مثال: لطفا خودت رو معرفی کن !", $backButton);
    $userCursor->setStep($from_id, 'chating');
    die;
}

# -------------- recive and send requests to chat bot -------------- #

if ($user->step == 'chating' && $type != 'supergroup') {
    $status = explode(' ', $text);
    $action = '';

    switch (end($status)) {
        case '!':
            $action = 'با حالت خشم و ایموجی ';
            break;
        case '#':
            $action = 'با حالت ملایم و ایموجی ';
            break;
        default:
            $action = '';
    }

    $text .= $action;
    $text = str_replace(['#', '!'], '', $text);

    if ($user->ai_type == 'gpt-3' && !$userLimits->gpt_3_limit >= 1) {
        $bot->sendMessage($from_id, 'اعتبار امروز شما برای استفاده از چت بات 3.5 به پایان رسید.', $aiKeyboard);
        die;
    }

    if ($user->ai_type == 'gpt-4' && !$userLimits->gpt_4_limit >= 1) {
        $bot->sendMessage($from_id, 'اعتبار امروز شما برای استفاده از چت بات 4 به پایان رسید.', $aiKeyboard);
        die;
    }

    $bot->sendChatAction($chat_id, 'typing');
    $chatResponse = $apiRequest->sendTextToGpt($text, $user->ai_type);

    if (!$chatResponse) {
        $bot->sendMessage($from_id, 'پاسخی دریافت نشد', mrk: 'Markdown');
        die;
    }

    if ($user->ai_type == 'gpt-3') {
        $userCursor->setLimit($from_id, 'gpt_3_limit', $userLimits->gpt_3_limit - 1);
    } else {
        $userCursor->setLimit($from_id, 'gpt_4_limit', $userLimits->gpt_4_limit - 1);
    }

    if ($user->ai_type == 'gpt-4') {
        $string = "\n\n *🔰 تعداد درخواست های باقی مانده امروز :* " . $userLimits->gpt_4_limit - 1;
    } else {
        $string = "\n\n *🔰 تعداد درخواست های باقی مانده امروز :* " . $userLimits->gpt_3_limit - 1;
    }

    $chatResponse = $chatResponse . $string;
    $bot->sendMessage($from_id, $chatResponse, mrk: 'Markdown');

    die;
}
