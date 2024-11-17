<?php

try {
    $inlineKeyboard = [
        'inline_keyboard' => []
    ];
    $result = $userCursor->getChannel('group');
    $sample = [];
    $counter = 1;

    foreach ($result as $key => $value) {
        $status = $bot->getChatMember('@' . $value->username, $from_id);
        if ($status->result->status == "left" || $status->result->status == "kicked") {
            $sample[] = [['text' =>  "عضویت و ورود به کانال ({$counter}) 📣", 'url' => "https://t.me/{$value->username}"]];
        }
        $counter++;
    }

    if ($sample) {
        $bot->deleteMessages($chat_id, $message_id);
        $text = "<b>🔰 - کاربر گرامی، جهت استفاده از خدمات ربات ابتدا در کانال های زیر عضو شوید</b>";
        $inlineKeyboard['inline_keyboard'] = $sample;
        $bot->sendMessage($chat_id, $text, keyboard: json_encode($inlineKeyboard));
        die;
    }
} catch (Exception $e) {
    // در این قسمت می‌توانید خطا را لاگ کنید یا پیام خطا را به کاربر ارسال کنید
    $errorMessage = "❌ یک خطا رخ داد: " . $e->getMessage();
    $bot->sendMessage($chat_id, $errorMessage);
}
