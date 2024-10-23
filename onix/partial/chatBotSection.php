<?php

# -------------- response for ChatBot button -------------- #

if ($text == '「 👨‍💻 چت با هوش مصنوعی 」') {
    $bot->sendMessage($from_id, 'لطفا یکی از نسخه های زیر را انتخاب کنید: ', $aiKeyboard);
    $userCursor->setStep($from_id, 'ai-select-category');
    die;
}

# -------------- change the AI type in database -------------- #

if ($user->step == 'ai-select-category') {
    if ($text == 'GPT 3.5') {
        if (!$userLimits->gpt_3_limit >= 1) {
            $bot->sendMessage($from_id, 'شما اعتبار کافی برای این بخش را ندارید.');
            die;
        }
        $userCursor->setAiType($from_id, 'gpt-3');
    } elseif ($text == 'GPT 4.O') {
        if (!$userLimits->gpt_4_limit >= 1) {
            $bot->sendMessage($from_id, 'شما اعتبار کافی برای این بخش را ندارید.');
            die;
        }
        $userCursor->setAiType($from_id, 'gpt-4');
    } else {
        die;
    }
    $bot->sendMessage($from_id, 'ورژن شما انتخاب شد، هم اکنون میتوانید چت کنید: ', $backButton);
    $userCursor->setStep($from_id, 'chating');
    die;
}

# -------------- recive and send requests to chat bot -------------- #

if ($user->step == 'chating') {
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
    $bot->sendMessage($from_id, $chatResponse);

    if ($user->ai_type == 'gpt-3') {
        $userCursor->setLimit($from_id, 'gpt_3_limit', $userLimits->gpt_3_limit - 1);
    } else {
        $userCursor->setLimit($from_id, 'gpt_4_limit', $userLimits->gpt_4_limit - 1);
    }
    die;
}
