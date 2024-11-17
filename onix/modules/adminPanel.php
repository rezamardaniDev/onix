<?php

if (($text == 'پنل ادمین' || $text == '🔙 بازگشت به ادمین پنل') && $user->is_admin) {
    $bot->sendMessage($from_id, 'به پنل مدیریت خوش آمدید', $adminPanelKeyboard);
    $userCursor->setStep($from_id, 'admin-panel');
    die;
}

if ($text == '🔺 - افزودن ادمین' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا شناسه کاربر مورد نظر را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'add-admins');
    die;
}

if ($text == '📊 - آمار ربات' && $user->is_admin) {
    $userCount  = $userCursor->getBotState();
    $groupCount = $userCursor->getGroupState();
    $activeUsers = $userCursor->getDailyUsers();

    $bot->sendChatAction($chat_id, 'typing');

    $botMessage = "
<b>آمار ربات تا این لحظه به شرح زیر است:

- تعداد کاربران ربات : {$userCount} نفر
- تعداد گروه های ربات : {$groupCount} گروه
- کاربران فعال امروز : {$activeUsers}
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


if ($text == '🔻 - حذف ادمین' && $user->is_admin) {
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

if ($text == '✍🏻 - پیام همگانی' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا یکی از گزینه های زیر را انتخاب کنید: ', $sendToAllKeyboard);
    die;
}

if ($text == '👥 -  پیام به کاربران' && $user->is_admin) {
    $bot->sendMessage($from_id, 'متن پیام را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'send_public_message_users');
    die;
}

if ($user->step ==  'send_public_message_users') {
    $userCursor->setPublicMessageUsers($from_id, $text);
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای کاربران ارسال می شود", $adminPanelKeyboard);
}

if ($text == '🤝 -  پیام به گروه ها' && $user->is_admin) {
    $bot->sendMessage($from_id, 'متن پیام را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'send_public_message_groups');
    die;
}

if ($user->step ==  'send_public_message_groups') {
    $userCursor->setPublicMessageGroups($from_id, $text);
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای گروه ها ارسال می شود", $adminPanelKeyboard);
}


if ($user->is_admin && $text == "📬 - فروارد همگانی") {
    $bot->sendMessage($from_id, 'لطفا یکی از گزینه های زیر را انتخاب کنید: ', $forwardToAllKeyboard);
    die;
}

if ($user->is_admin && $text == '🤝 -  فروارد به گروه ها') {
    $bot->sendMessage($from_id, 'پیام خود را برای ربات فروارد کنید :', $backToAdmin);
    $userCursor->setStep($from_id, 'forward_public_message_group');
    die;
}



if ($user->step ==  'forward_public_message_group') {
    $userCursor->setForwardMessage($chat_id, $from_id, $message_id, 'groups');
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای کاربران ارسال می شود", $adminPanelKeyboard);
}


if ($user->is_admin && $text == '👥 -  فروارد به کاربران') {
    $bot->sendMessage($from_id, 'پیام خود را برای ربات فروارد کنید :', $backToAdmin);
    $userCursor->setStep($from_id, 'forward_public_message_users');
    die;
}


if ($user->step ==  'forward_public_message_users') {
    $userCursor->setForwardMessage($chat_id, $from_id, $message_id, 'users');
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای کاربران ارسال می شود", $adminPanelKeyboard);
}


if ($text ==  '🔔 - افزودن پاسخ سریع' && $user->is_admin) {
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

if ($text == '🔕 - حذف پاسخ سریع'  && $user->is_admin) {
    $bot->sendMessage($from_id, 'کلمه ای که میخواهید پاک شود را بده');
    $userCursor->setStep($from_id, 'delete-force-message');
    die;
}

if ($user->step ==  'delete-force-message') {
    $userCursor->deleteForceMessage($text);
    $bot->sendMessage($chat_id, 'کلمه حذف شد', message_id: $message_id);
    die;
}

if ($text == '👥 - مدیریت کاربران' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا یکی گزینه های زیر را انتخاب کنید: ', $usersSectionButton);
    die;
}

if ($text == '🔎 - جستجوی کاربر' && $user->is_admin) {
    $bot->sendMessage($from_id, 'آیدی عددی فرد مورد نظر را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'search-user');
    die;
}

if ($user->step ==  'search-user') {

    $getUserInformation = $userCursor->getUser($text);
    $getLimits = $userCursor->getLimits($text);

    $botMessage = "
<b> 💭 | حساب کاربری شما در ربات ما 

📃 | شناسه کاربر : {$getUserInformation->chat_id}
📝 | وضعیت ادمینی : {$getUserInformation->is_admin}
🆔 | وضعیت بن : {$getUserInformation->is_ban}
</b> ";

    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, $botMessage, $usersSectionButton);
    die;
}

if ($text ==  '🚫 - مسدود سازی کاربر' && $user->is_admin) {
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

if ($text ==  '❇️ - رفع مسدودیت کاربر' && $user->is_admin) {
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

if ($text == '📣 تنظیم کانال ها' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا یکی از گزینه های زیر را انتخاب کنید: ', $setChannelsButton);
    die;
}

if ($text == 'افزودن اسپانسری ربات' && $user->is_admin) {
    $bot->sendMessage($from_id, "یوزرنیم کانال مورد نظر را بدون @ وارد کنید:\nربات در کانال مورد نظر باید ادمین باشد.", $backToAdmin);
    $userCursor->setStep($from_id, 'set;private;lock');
    die;
}

if ($user->step == 'set;private;lock') {
    $userCursor->setChannel($text, 'private');
    $userCursor->setStep($from_id, 'admin-panel');

    $bot->sendMessage($from_id, 'کانال مورد نظر ذخیره شد.', $setChannelsButton);
    die;
}

if ($text == 'حذف اسپانسری ربات' && $user->is_admin) {
    $botMessage = "یوزرنیم کانال مورد نظر را بدون @ وارد کنید \n";
    $result = $userCursor->getChannel("private");
    if ($result) {
        foreach ($result as $key => $value) {
            $botMessage .= "\n" . $value->username;
        }
    }
    $bot->sendMessage($from_id, $botMessage, $backToAdmin);
    $userCursor->setStep($from_id, 'del;private;lock');
    die;
}

if ($user->step == 'del;private;lock') {
    $userCursor->deleteChannel($text);
    $userCursor->setStep($from_id, 'admin-panel');

    $bot->sendMessage($from_id, 'کانال مورد نظر حذف شد.', $setChannelsButton);
    die;
}

if ($text == 'افزودن اسپانسری گروه' && $user->is_admin) {
    $bot->sendMessage($from_id, "یوزرنیم کانال مورد نظر را بدون @ وارد کنید:\nربات در کانال مورد نظر باید ادمین باشد.", $backToAdmin);
    $userCursor->setStep($from_id, 'set;group;lock');
    die;
}

if ($user->step == 'set;group;lock') {
    $userCursor->setChannel($text, 'group');
    $userCursor->setStep($from_id, 'admin-panel');

    $bot->sendMessage($from_id, 'کانال مورد نظر ذخیره شد.', $setChannelsButton);
    die;
}

if ($text == 'حذف اسپانسری گروه' && $user->is_admin) {
    $botMessage = "یوزرنیم کانال مورد نظر را بدون @ وارد کنید \n";
    $result = $userCursor->getChannel("group");
    if ($result) {
        foreach ($result as $key => $value) {
            $botMessage .= "\n" . $value->username;
        }
    }
    $bot->sendMessage($from_id, $botMessage, $backToAdmin);
    $userCursor->setStep($from_id, 'del;group;lock');
    die;
}

if ($user->step == 'del;group;lock') {
    $userCursor->deleteChannel($text);
    $userCursor->setStep($from_id, 'admin-panel');

    $bot->sendMessage($from_id, 'کانال مورد نظر حذف شد.', $setChannelsButton);
    die;
}

if ($text == 'افزودن کانال تبلیغاتی' && $user->is_admin) {
    $bot->sendMessage($from_id, "یوزرنیم کانال مورد نظر را بدون @ وارد کنید:\nربات در کانال مورد نظر باید ادمین باشد.", $backToAdmin);
    $userCursor->setStep($from_id, 'set;sponsor;lock');
    die;
}

if ($user->step == 'set;sponsor;lock') {
    $userCursor->setChannel($text, 'sponsor');
    $userCursor->setStep($from_id, 'admin-panel');

    $bot->sendMessage($from_id, 'کانال مورد نظر ذخیره شد.', $setChannelsButton);
    die;
}

if ($text == 'حذف کانال تبلیغاتی' && $user->is_admin) {
    $botMessage = "یوزرنیم کانال مورد نظر را بدون @ وارد کنید \n";
    $result = $userCursor->getChannel("sponsor");
    if ($result) {
        foreach ($result as $key => $value) {
            $botMessage .= "\n" . $value->username;
        }
    }
    $bot->sendMessage($from_id, $botMessage, $backToAdmin);
    $userCursor->setStep($from_id, 'del;sponsor;lock');
    die;
}

if ($user->step == 'del;sponsor;lock') {
    $userCursor->deleteChannel($text);
    $userCursor->setStep($from_id, 'admin-panel');

    $bot->sendMessage($from_id, 'کانال مورد نظر حذف شد.', $setChannelsButton);
    die;
}
