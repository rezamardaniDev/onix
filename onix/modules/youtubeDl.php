<?php

if ($text == '「 ▶️ دانلود یوتوب 」') {
    $bot->sendMessage($from_id, 'لینک ویدئو رو بفرست: ', $backButton);
    $userCursor->setStep($from_id, 'yt-dl');
    die;
} else {
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, '<b>درحال بررسی لینک ...</b>');

    $response = $apiRequest->getYoutubeId($text);
    $getDownloadID = $apiRequest->getYoutubeDownloadId($response);

    if (!$getDownloadID) {
        $bot->editMessage($from_id, "خطا! لینک ارسال شده صحیح نمیباشد یا مشکلی در روند دانلود پیش آمده است.\n\nلطفا مجددا لینک مورد نظر را ارسال کنید: ", $message_id + 1);
        die;
    }

    $link_360 = $getDownloadID[6]->id;
    $link_480 = $getDownloadID[7]->id;
    $link_720 = $getDownloadID[8]->id;

    $bot->editMessage($from_id, '<b>درحال ساخت لینک های دانلود ...</b>', $message_id + 1);

    $getLink360 = $apiRequest->getYoutubeFile($link_360);
    $getLink480 = $apiRequest->getYoutubeFile($link_480);
    $getLink720 = $apiRequest->getYoutubeFile($link_720);

    $bot->editMessage($from_id, "برای دانلود کافیست روی لینک مرتبط کلیک کنید: \n\nلینک های دانلود بعد از 5 ساعت منقضی خواهند شد.", $message_id + 1, json_encode([
        'inline_keyboard' => [
            [['text' => 'دانلود کیفیت 360', 'url' => $getLink360]],
            [['text' => 'دانلود کیفیت 480', 'url' => $getLink480]],
            [['text' => 'دانلود کیفیت 720', 'url' => $getLink720]]
        ]
    ]));
    $userCursor->setStep($from_id, 'home');
    $bot->sendMessage($from_id, 'به منو دانلودر بازگشتید', $downloaderKeyboard);
    die;
}
