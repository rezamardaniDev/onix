<?php

if($text == '「 🎨 لوگو اسم 」'){
    if($userLimits->logo_limit <= 0){
        $bot->sendMessage($from_id , "تعداد ریکوست های امروز شما تمام شد ." , $hoshmandKeyboard);
        die;
    }
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, 'اسم مورد نظر خود را برای ساخت لوگو به انگلیسی وارد کنید: ', $backButton);
    $userCursor->setStep($from_id, 'cr-logo');
    die;
}else{
    $bot->sendMessage($from_id, 'لطفا اندکی صبر کنید...');
    $response = $apiRequest->makeLogo($text);
    $bot->sendChatAction($from_id, 'upload_photo');
    $bot->sendPhoto($from_id, $response, 'لوگو اسم شما آماده شد!', $hoshmandKeyboard);
    $userCursor->setLimit($from_id , 'logo_limit' , $userLimits->logo_limit - 1);
    $userCursor->setStep($from_id, 'home');
    die;
}