<?php

if (!$user) {
    $userCursor->addNewUser($from_id);
}
if (!$userLimits) {
    $userCursor->addNewUserLimits($from_id);
}
$botMessage = "سلام, به ربات هوش مصنوعی اونیکس خوش آمدید.\n\nجهت ادامه روی یکی از دکمه های زیر کلیک کنید.\n\n" . '<b>' . "ساخته شده توسط : " . '<a href="' . 'https://t.me/OnyxAiTeam' . '">𝗢𝗻𝘆𝘅𝗧𝗲𝗮𝗺 🦜</a>' . '</b>';
$keyStart = $user->is_admin ? $mainKeyboard2 : $mainKeyboard1;
$bot->sendMessage($chat_id, $botMessage, $keyStart);
$userCursor->setStep($from_id, 'home');
die;
