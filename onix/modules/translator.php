<?php

if ($text == '「 🗣 مترجم متن 」' || $user->step == 'translator') {
    if ($text == '「 🗣 مترجم متن 」') {
        $bot->sendMessage($from_id, 'لطفا نوع ترجمه را انتخاب کنید: ', $translateKeyboard);
        $userCursor->setStep($from_id, 'translator');
        die;
    }
    if ($text == '「 🇮🇷 مترجم انگلیسی به فارسی 」') {
        $bot->sendMessage($from_id, 'لطفا متن انگلیسی خود را وارد کنید: ', $backButton);
        $userCursor->setStep($from_id, 'translate-en-fa');
        die;
    }

    if ($text == '「 🏴󠁧󠁢󠁥󠁮󠁧󠁿 مترجم فارسی به انگلیسی 」') {
        $bot->sendMessage($from_id, 'لطفا متن فارسی خود را وارد کنید: ', $backButton);
        $userCursor->setStep($from_id, 'translate-fa-en');
        die;
    }
    die;
}


if (preg_match('/^translate/', $user->step)) {
    if ($user->step == 'translate-en-fa') {
        $response = $apiRequest->translateToFa($text);
        $bot->sendMessage($from_id, $response, $translateKeyboard);
        $userCursor->setStep($from_id, 'translator');
        die;
    }

    if ($user->step == 'translate-fa-en') {
        $response = $apiRequest->translateToEn($text);
        $bot->sendMessage($from_id, $response, $translateKeyboard);
        $userCursor->setStep($from_id, 'translator');
        die;
    }
}
