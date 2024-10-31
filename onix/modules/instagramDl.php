<?php

if ($text == '「 🔮 دانلود اینستاگرام 」') {
    $bot->sendMessage($from_id, 'لینک ویدئو یا ریلز مورد نظر را ارسال کنید: ', $backButton);
    $userCursor->setStep($from_id, 'insta');
    die;
} else {
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, '<b>درحال بررسی لینک ...</b>');

    $shortLink = explode('/', $text)[4];
    $response = $apiRequest->instaDownloader($shortLink);

    if (!$response->media[0]->url) {
        $bot->editMessage($from_id, "خطا! لینک ارسال شده صحیح نمیباشد یا مشکلی در روند دانلود پیش آمده است.\n\nلطفا مجددا لینک مورد نظر را ارسال کنید: ", $message_id + 1);
        die;
    }
    $bot->editMessage($from_id, '<b>درحال ارسال فایل ...</b>', $message_id + 1);

    $link = $response->media[0]->url;
    $caption = $response->caption . "\n\n<b>🦜 Download by @OnyxAiRoBot</b>";

    $bot->sendChatAction($from_id, 'upload_document');
    $bot->sendVideo($from_id, $link, $caption, $downloaderKeyboard);
    $userCursor->setStep($from_id, 'home');
    die;
}
