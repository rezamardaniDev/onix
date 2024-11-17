<?php

if (!$user->is_admin) {
    if ($type == 'supergroup') {
        $commands = ['انیکس', 'اونیکس', 'ارز', 'اوقات', 'جوک', 'سخن بزرگان', 'دانستنی', 'فال', 'راهنما', 'ترجمه به انگلیسی', 'ترجمه به فارسی'];
        foreach ($commands as $value) {
            if ((strpos($text, $value) === 0) || array_key_exists(explode(' ', $text)[0], $cryptoItems) || array_key_exists(explode(' ', $text)[1], $cryptoItems)) {
                require 'partial/forceJoinGp.php';
            }
        }
    } else {
        require 'partial/forceJoinPv.php';
    }
}

if (!$activeUser && $type != "supergroup") {
    $userCursor->setActiveUser($from_id);
}

if ($user->is_ban == 1) {
    $bot->sendMessage($from_id, '🚫 شما از ربات مسدود شدید.');
    die;
}

if ($text && $type == 'supergroup') {
    foreach ($getWord as $word) {
        if ($text == $word->question) {
            $bot->sendMessage($chat_id, $word->answer, message_id: $message_id);
        }
    }
}

if (preg_match('/del_/', $data)) {
    $bot->deleteMessages($chat_id, explode('_', $data)[1]);
    die;
}

if($type == 'supergroup'){
      if (!$group) {
        $groupCursor->addNewGroup($chat_id);
    }
}

# -------------- send message when add bot to group -------------- #

if ($bot_join == 'onixToolsBot') {
    $bot->sendMessage($from_id, $bot_join);
    if (!$group) {
        $groupCursor->addNewGroup($chat_id);
    }
    $botMessage = "
• ربات با موفقیت به گروه شما اضافه شد!
• حال لازم است ربات را ادمین کامل گروه نمایید

• تا فرآیند نصب و پیکربندی انجام شود

⚠️ توجه : در صورتی که ربات را ادمین کردید این پیام را نادیده بگیرید !
    ";
    $bot->sendMessage($chat_id, $botMessage, $startChannelKeyboard);
    $bot->sendMessage($logChannelId, "ربات در یک گروه جدید اضافه شد!\n\nنام گروه: {$group_title}\nشناسه گروه: {$group_id}\nلینک گروه: {$group_uname}");
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

    $bot->sendMessage($chat_id, $botMessage, mrk: 'Markdown', keyboard: $startChannelKeyboard);
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
