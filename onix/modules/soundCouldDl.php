<?php

if ($text == '「 📻 دانلود ساندکلود 」'){
    if ($userLimits->dl_soundcloud < 1) {
        $bot->sendMessage($from_id, 'شما اعتبار کافی برای این بخش را ندارید.');
        die;
    }
    $bot->sendMessage($from_id,'لطفا لینک موزیک را ارسال کنید: ', $backButton);
    $userCursor->setStep($from_id, 'get-sound-cloud');
    die;
}else{
    $bot->sendMessage($from_id, '<b>درحال ارتباط با سرور ...</b>');
    $response = $apiRequest->getSoundCloudId($text);
    $soundInfo = $apiRequest->getSoundCloudInfo($response)->result;
    $soundName = str_replace('.mp3', '', $soundInfo->title);

    $bot->editMessage($chat_id, '<b>فایل مورد نظر یافت شد! درحال ارسال به تلگرام ...</b>', $message_id + 1);
    $bot->sendChatAction($from_id, 'upload_document');

    $getFile = $apiRequest->getSoundCloudFile($response);

    $rand = rand(124588, 854963);
    $audioFile = "SoundCloud-{$response}.mp3";

    file_put_contents($audioFile, $getFile);
    $bot->sendAudio($from_id, "https://fara-it.ir/onix/{$audioFile}", $soundName, $downloaderKeyboard);
    $userCursor->setLimit($from_id, 'dl_soundcloud', $userLimits->dl_soundcloud - 1);
    unlink($audioFile);
    $userCursor->setLimit($from_id , 'dl_soundcloud' , $userLimits->dl_soundcloud - 1);


    die;
}