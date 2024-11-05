<?php

if (($text == 'پنل ادمین' || $text == 'بازگشت به ادمین پنل') && $user->is_admin) {
    $bot->sendMessage($from_id, 'به پنل مدیریت خوش آمدید', $adminPanelKeyboard);
    $userCursor->setStep($from_id, 'admin-panel');
    die;
}

if ($text == 'افزودن ادمین' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا شناسه کاربر مورد نظر را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'add-admins');
    die;
}

if ($text == 'آمار' && $user->is_admin) {
    $userCount  = $userCursor->getBotState();
    $groupCount = $userCursor->getGroupState();

    $bot->sendChatAction($chat_id, 'typing');

    $botMessage = "
<b>آمار ربات تا این لحظه به شرح زیر است:

- تعداد کاربران ربات : {$userCount} نفر
- تعداد گروه های ربات : {$groupCount} گروه
</b>
    ";
    $bot->sendMessage($from_id, $botMessage, message_id: $message_id);
    die;
}

if ($user->step == 'add-admins') {
    $checkExistsUser = $userCursor->getUser($text);
    if (!$checkExistsUser) {
        $bot->sendMessage($from_id, 'چنین کاربری در دیتابیس ربات وجود ندارد!', $adminPanelKeyboard);
        $userCursor->setStep($from_id, 'admin-panel');
    } else {
        $userCursor->setAdmin($text);
        $bot->sendMessage($from_id, 'کاربر مورد نظر ادمین شد!', $adminPanelKeyboard);
        $userCursor->setStep($from_id, 'admin-panel');
    }
    die;
}


if ($text == 'حذف ادمین' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا شناسه کاربر مورد نظر را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'delete-admins');
    die;
}

if ($user->step == 'delete-admins') {
    $checkExistsUser = $userCursor->getUser($text)->is_admin;
    if (!$checkExistsUser) {
        $bot->sendMessage($from_id, 'این کاربر ادمین نیست یا در دیتابیس ربات وجود ندارد!', $adminPanelKeyboard);
        $userCursor->setStep($from_id, 'admin-panel');
    } else {
        $userCursor->deleteAdmin($text);
        $bot->sendMessage($from_id, 'کاربر مورد نظر عزل شد شد!', $adminPanelKeyboard);
        $userCursor->setStep($from_id, 'admin-panel');
    }
    die;
}

if ($text == 'پیام همگانی' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا یکی از گزینه های زیر را انتخاب کنید: ', $sendToAllKeyboard);
    die;
}

if ($text == 'پیام همگانی کاربران' && $user->is_admin) {
    $bot->sendMessage($from_id, 'متن پیام را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'send_public_message_users');
    die;
}

if ($user->step ==  'send_public_message_users') {
    $userCursor->setPublicMessageUsers($from_id, $text);
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای کاربران ارسال می شود", $adminPanelKeyboard);
}

if ($text == 'پیام همگانی گروه ها' && $user->is_admin) {
    $bot->sendMessage($from_id, 'متن پیام را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'send_public_message_groups');
    die;
}

if ($user->step ==  'send_public_message_groups') {
    $userCursor->setPublicMessageGroups($from_id, $text);
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای گروه ها ارسال می شود", $adminPanelKeyboard);
}

if ($text == 'پاسخ سریع') {
    $bot->sendMessage($from_id, 'لطفا کلمه مورد نظر را در خط اول و پاسخ آن را در خط دوم وارد کنید: ');
    $userCursor->setStep($from_id, 'add-force-message');
    die;
}

if ($user->step == 'add-force-message') {
    $cutter = explode("\n", $text);
    if (count($cutter) == 2) {
        $userCursor->addNewForceMessage($cutter);
        $bot->sendMessage($from_id, 'جمله و پاسخ شما ذخیره شد.', $mainKeyboard2);
        $userCursor->setStep($from_id, 'home');
    } else {
        $bot->sendMessage($from_id, 'مقادیر اشتباه است!');
    }
    die;
}

if ($text == 'حذف پاسخ سریع') {
    $bot->sendMessage($from_id, 'کلمه ای که میخواهید پاک شود را بده');
    $userCursor->setStep($from_id, 'delete-force-message');
    die;
}

if ($user->step ==  'delete-force-message') {
    $userCursor->deleteForceMessage($text);
    $bot->sendMessage($chat_id, 'کلمه حذف شد', message_id: $message_id);
    die;
}

if ($text == 'کاربران' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا یکی گزینه های زیر را انتخاب کنید: ', $usersSectionButton);
    die;
}

if ($text == 'جستجوی کاربر' && $user->is_admin) {
    $bot->sendMessage($from_id, 'آیدی عددی فرد مورد نظر را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'search-user');
    die;
}

if ($user->step ==  'search-user') {

    $getUserInformation = $userCursor->getUser($text);
    $getLimits = $userCursor->getLimits($text);

    $botMessage = "
<b> 💭 | حساب کاربری شما در ربات ما 

📃 | نام شما : {$getUserInformation->chat_id}
📝 | یوزرنیم شما : {$getUserInformation->is_admin}
🆔 | شناسه کاربری شما : {$getUserInformation->is_ban}
</b> ";

    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, $botMessage, $usersSectionButton);
    die;
}

if ($text == 'مسدود سازی کاربر' && $user->is_admin) {
    $bot->sendMessage($from_id, 'شناسه کاربر مورد نظر را برای مسدود کردن ارسال کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'ban-user');
    die;
}

if ($user->step == 'ban-user') {
    $userCursor->banUser($text);
    $userCursor->setStep($from_id, 'admin-panel');

    $bot->sendMessage($from_id, 'کاربر مورد نظر از ربات بن شد', $usersSectionButton);
    $bot->sendMessage($text, 'حساب کاربری شما توسط ربات مسدود گردید');
    die;
}

if ($text == 'رفع مسدودیت کاربر' && $user->is_admin) {
    $bot->sendMessage($from_id, 'شناسه کاربر مورد نظر را برای رفع مسدودیت ارسال کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'unban-user');
    die;
}

if ($user->step == 'unban-user') {
    $userCursor->unBanUser($text);
    $userCursor->setStep($from_id, 'admin-panel');

    $bot->sendMessage($from_id,  'حساب کاربری فرد مورد نظر رفع انسداد گردید.', $usersSectionButton);
    $bot->sendMessage($text, 'حساب کاربری شما توسط رفع مسدودیت شد');
    die;
}
