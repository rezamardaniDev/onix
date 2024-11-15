<?php

if ($text == '「 📻 دانلود ساندکلود 」') {
    if ($userLimits->dl_soundcloud < 1) {
        $bot->sendMessage($from_id, 'شما اعتبار کافی برای این بخش را ندارید.', $downloaderKeyboard);
        die;
    }
    $bot->sendMessage($from_id, 'لطفا لینک موزیک را ارسال کنید: ', $backButton);
    $userCursor->setStep($from_id, 'get-sound-cloud');
    die;
} else {
    $bot->sendMessage($from_id, '<b>درحال ارتباط با سرور ...</b>');
    $response = $apiRequest->getSoundCloudId($text);
    $soundInfo = $apiRequest->getSoundCloudInfo($response)->result;
    $soundName = str_replace('.mp3', '', $soundInfo->title);
    if ($response) {
        $bot->editMessage($chat_id, '<b>فایل مورد نظر یافت شد! درحال ارسال به تلگرام ...</b>', $message_id + 1);
        $bot->sendChatAction($from_id, 'upload_document');

        $getFile = $apiRequest->getSoundCloudFile($response);
        $audioFile = "{$soundName}.mp3";

        file_put_contents($audioFile, $getFile);
        $bot->sendAudio($from_id, "https://fara-it.ir/onix/{$audioFile}", $soundName  . "\n\n<b>🦜 Download by @OnyxAiRoBot</b>", $downloaderKeyboard);
        unlink($audioFile);
        $userCursor->setLimit($from_id, 'dl_soundcloud', $userLimits->dl_soundcloud - 1);
        $userCursor->setStep($from_id, 'home');
    } else {
        $userCursor->setStep($from_id, 'home');
        $bot->sendMessage($chat_id, '<b>فایل مورد نظر یافت نشد!  ...</b>', $downloaderKeyboard);
    }
    die;
}
