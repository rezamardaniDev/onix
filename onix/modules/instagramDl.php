<?php

if ($text == '「 🔮 دانلود اینستاگرام 」'){
    $bot->sendMessage($from_id, 'لینک ویدئو یا ریلز مورد نظر را ارسال کنید: ', $backButton);
    $userCursor->setStep($from_id, 'insta');
    die;
}else{
    $shortLink = explode('/', $text)[4];
    $response = $apiRequest->instaDownloader($shortLink);

    $link = $response->media[0]->url;
    $caption = $response->caption . "\n\n<b>🦜 Download by @OnyxAiRoBot</b>";

    $bot->sendChatAction($from_id, 'upload_document');
    $bot->sendVideo($from_id, $link, $caption);

    die;
}