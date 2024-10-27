<?php

if($text == '「 🎧 جستجوی موزیک 」'){
    if($userLimits->search_music <= 0){
        $bot->sendMessage($from_id , "تعداد ریکوست های امروز شما تمام شد ." , $mainKeyboard);
        die;
    }
    $bot->sendMessage($from_id, "لطفا نام موزیک  مورد نظر تو ارسال کن: \n\nمثال:\nعاشق دل شکسته معین\nکجای این شهر", $backButton);
    $userCursor->setStep($from_id, 'get-music');
    die;
}

if($userLimits->search_music <= 0){
    $bot->sendMessage($from_id , "تعداد ریکوست های امروز شما تمام شد ." , $mainKeyboard);
    die;
}
$bot->sendMessage($from_id, 'لطفا اندکی صبر کنید...');
$response = $apiRequest->radioJavan($text)->result->top[0];
if (empty($response)) {
    $bot->sendMessage($from_id, 'موزیک مورد نظر یافت نشد');
    die;
}

$link = $response->link;
$artist = $response->artist;
$song_name = $response->song;

$bot->sendChatAction($from_id, 'upload_document');
$bot->sendAudio($from_id, $link, "{$artist} - {$song_name}", $mainKeyboard);
$userCursor->setLimit($from_id , 'search_music' , $userLimits->search_music - 1);
$userCursor->setStep($from_id, 'home');
die;