<?php

if ($text == '「 📱 قیمت گوشی 」') {
    $bot->sendMessage($from_id, "لطفا یکی از مدل های زیر را انتخاب کنید یا اسم مدل مد نظر خود را وارد کنید : ", $phonePriceKeyboard);
    $userCursor->setStep($from_id, 'phoneSelection');
}

if (in_array($text, ["SAMSUNG", "APPLE", "XIAOMI" , "NOKIA"]) && $user->step == "phoneSelection") {
    $keyboard;
    switch ($text) {
        case "SAMSUNG":
            $keyboard = $samsungKeyboard;
            break;
        case "APPLE":
            $keyboard = $appleKeyboard;
            break;
        case "XIAOMI":
            $keyboard = $xiaomiKeyboard;
            break;
        case "NOKIA":
            $response = $apiRequest->getPriceOfPhone("nokia");
            $bot->sendMessage($from_id, $response);
            die;
        default:
            $keyboard = null;
    }
    $bot->sendMessage($from_id, "لطفا یکی از مدل های زیر را انتخاب کنید یا اسم مدل مد نظر خود را وارد کنید : ", $keyboard);
    $userCursor->setStep($from_id, 'choosePhone');
    die;
}

if ($user->step == "choosePhone") {
    $bot->sendChatAction($chat_id, 'typing');

    $action = '';
    switch ($text) {
        case 'سری S':
            $action = 'Samsung Galaxy S';
            break;
        case 'سری A':
            $action = 'Samsung Galaxy A';
            break;
        case 'سری M':
            $action = 'Samsung Galaxy M';
            break;
        case 'سری Z':
            $action = 'Samsung Galaxy Z';
            break;
        case 'سری POCO':
            $action = 'poco';
            break;
        case 'سری redmi':
            $action = 'redmi';
            break;
        case 'Iphone':
            $action = 'Iphone';
            break;
        case 'Ipad':
            $action = 'Ipad';
            break;
        default:
            $action = "$text";
    }
    $response = $apiRequest->getPriceOfPhone($action);
    $bot->sendMessage($from_id, $response);
    die;
}