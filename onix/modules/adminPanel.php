<?php

if (($text == 'پنل ادمین' || $text == 'بازگشت  به ادمین پنل') && $user->is_admin) {
    $bot->sendMessage($from_id, 'به پنل مدیریت خوش آمدید', $adminPanelKeyboard);
    $userCursor->setStep($from_id, 'admin-panel');
    die;
}

if ($text == 'افزودن ادمین' && $user->is_admin) {
    $bot->sendMessage($from_id, 'لطفا شناسه کاربر مورد نظر را وارد کنید: ', $backToAdmin);
    $userCursor->setStep($from_id, 'add-admins');
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
    $bot->sendMessage($from_id, "پیام را وارد کنید : ", $backToAdmin);
    $userCursor->setStep($from_id, "send_public_message");
}

if ($user->step == "send_public_message") {
    $userCursor->setPublicMessage($from_id, $text);
    $userCursor->setStep($from_id, 'admin-panel');
    $bot->sendMessage($from_id, "پیام شما در دیتابیس ذخیره شد و در اولین فرصت برای کاربران ارسال می شود", $adminPanelKeyboard);
}
