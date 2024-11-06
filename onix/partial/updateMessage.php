<?php


if($user->is_ban == 1){
    $bot->sendMessage($from_id, '🚫 شما از ربات مسدود شدید.');
    die;
}

if ($text && $type == 'supergroup' && $getWord &&  $r_user_name == "onixToolsBot") {
    $bot->sendMessage($chat_id, $getWord, message_id: $message_id);
}

if (preg_match('/del_/', $data)) {
    $bot->deleteMessages($chat_id, explode('_', $data)[1]);
    die;
}

# -------------- send message when add bot to group -------------- #

if ($bot_join == 'onixToolsBot') {
    if (!$group) {
        $groupCursor->addNewGroup($chat_id);
    }
    $botMessage = "
• ربات با موفقیت به گروه شما اضافه شد!
• حال لازم است ربات را ادمین کامل گروه نمایید

• تا فرآیند نصب و پیکربندی انجام شود

⚠️ توجه : در صورتی که ربات را ادمین کردید این پیام را نادیده بگیرید !
    ";
    $bot->sendMessage($chat_id, $botMessage);
    die;
}

# -------------- send message when is admin -------------- #

if ($bot_admin == "onixToolsBot" && $bot_status == "administrator") {
    if (!$group) {
        $groupCursor->addNewGroup($chat_id);
    }

    $groupCursor->setActive($chat_id, 1);
    $botMessage = "
    *✅ اونیکس 🦜, با موفقیت در گروه نصب شد!
    
    برای مشاهده امکانات ربات در گروه لطفا کلمه *راهنما* را ارسال کنید\n\n
    
    🤖 بخشی از قابلیت های ربات:*
    ```
    چت با هوش مصنوعی ChatGpt 3.5 Turbo
    ارز های دیجیتال 
    اوقات شرعی  
    اخبار و...
    ```";

    $bot->sendMessage($chat_id, $botMessage, mrk: 'Markdown' , keyboard:$startChannelKeyboard);
    $groupCursor->setActive($chat_id, 1);
    die;
}

# -------------- first comment in group -------------- #

if ($update->message->from->first_name == 'Telegram') {
    $botMessage = "
به کامنتای هم دیگه احترام بزارید .

« توهین و بی احترامی به هم ممنوع ، نظرات آزاد »
    ";
    $bot->sendMessage($update->message->chat->id, $botMessage, message_id: $message_id);
}
