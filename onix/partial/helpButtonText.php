<?php

if ($text == 'چگونه ربات را به گروه اد کنم؟') {
    $bot->sendMessage($from_id, $how_add_to_group, json_encode([
        'inline_keyboard' => [
            [['text' =>  '+ افزودن ربات به گروه +', 'url' => 'https://telegram.me/onixToolsBot?startgroup=start']]
        ]
    ]));
    die;
}

if ($text == 'چگونه داخل گروه از ربات استفاده کنم؟'){
    $bot->sendMessage($from_id, $how_use_in_group);
    die;
}

if ($text == 'درخواست اسپانسری دارم؟'){
    $bot->sendChatAction($from_id, 'typing');
    $bot->sendMessage($from_id, $sponsering_text);
    die;
}

