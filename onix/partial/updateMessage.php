<?php


if ($bot_join == 'onixToolsBot') {
    if (!$group) {
        $groupCursor->addNewGroup($chat_id);
    }
    $botMessage = "• ربات با موفقیت به گروه شما اضافه شد!
• حال لازم است ربات را ادمین کامل گروه نمایید

• تا فرآیند نصب و پیکربندی انجام شود";
    $bot->sendMessage($chat_id, $botMessage);
}

# -------------- send message when is admin -------------- #

if ($bot_admin == "onixToolsBot" && $bot_status == "administrator") {
    if (!$group) {
        $groupCursor->addNewGroup($chat_id);
    }
    $groupCursor->setActive($chat_id, 1);
    $botMessage = "
    <b>✅ اونیکس 🦜, با موفقیت در گروه نصب شد!
    
    برای دسترسی به بخش دستورات و قابلیت های ربات و همچنین اموزش کار با اونیکس بر روی دکمه (LAUNCH) کلیک کنید.\n\n
    
    🤖 بخشی از قابلیت های ربات:
    چت با هوش مصنوعی ChatGpt 3.5 Turbo
    ارز های دیجیتال 
    اوقات شرعی 
    اخبار و...</b>";
    $bot->sendMessage($chat_id, $botMessage);
    $groupCursor->setActive($chat_id, 1);
}

# -------------- send message when added to group but not admin -------------- #

if ($type == "supergroup" && $group->is_active != 1) {
    $botMessage = "
• ربات را ادمین کامل گروه نمایید

• تا بتوانید از قابلیت های ربات استفاده نمایید";
    $bot->sendMessage($chat_id, $botMessage);
    die;
}

# -------------- change is_active to 0 when banned -------------- #


if ($bot_admin == "onixToolsBot" && ($bot_status == "kicked" || $bot_status == "member")) {
    $groupCursor->setActive($chat_id, 0);
}



# -------------- first comment in group -------------- #

if ($update->message->from->first_name == 'Telegram') {
    $botMessage = "
به کامنتای هم دیگه احترام بزارید .

« توهین و بی احترامی به هم ممنوع ، نظرات آزاد »
    ";
    $bot->sendMessage($update->message->chat->id, $botMessage, message_id: $message_id);
}


