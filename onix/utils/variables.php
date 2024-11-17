<?php

# -------------- Message Updates -------------- #
if (isset($update->message)) {
    $message     = $update->message;
    $text        = $message->text;
    $from_id     = $message->from->id;
    $first_name  = $message->from->first_name;
    $user_name   = $message->from->username;
    $chat_id     = $message->chat->id;
    $type        = $message->chat->type;
    $first_name  = htmlspecialchars($message->from->first_name, ENT_QUOTES, 'UTF-8');
    $message_id  = $update->message->message_id;
    $bot_join    = $update->message->new_chat_participant->username;

    $group_id    = $update->message->chat->id;
    $group_title = $update->message->chat->title;
    $group_uname = $update->message->chat->username ?? 'ندارد';
}

if (isset($update->message->reply_to_message)) {
    $message       = $update->message->reply_to_message;
    $r_text        = $message->text;
    $r_from_id     = $message->from->id;
    $r_chat_id     = $message->chat->id;
    $r_user_name   = $message->from->username;
    $r_first_name  = htmlspecialchars($message->from->first_name, ENT_QUOTES, 'UTF-8');
    $r_message_id  = $update->message->message_id;
    $r_join_member = $message->new_chat_participant;
    $r_left_member = $message->left_chat_participant;
}

if (isset($update->my_chat_member)) {
    $chat_id     = $update->my_chat_member->chat->id;
    $bot_admin   = $update->my_chat_member->new_chat_member->user->username;
    $bot_status  = $update->my_chat_member->new_chat_member->status;
}
# -------------- Callback Updates -------------- #

if (isset($update->callback_query)) {
    $callback_id = $update->callback_query->id;
    $from_id     = $update->callback_query->from->id;
    $chat_id     = $update->callback_query->message->chat->id;
    $data        = $update->callback_query->data;
    $query_id    = $update->callback_query->id;
    $type        = $update->callback_query->message->chat->type;
    $message_id  = $update->callback_query->message->message_id;
}

$logChannelId = '-1002307806234';

$user = $userCursor->getUser($from_id);
$userLimits = $userCursor->getLimits($from_id);
$group = $groupCursor->getGroup($chat_id);
$getWord = $userCursor->getForceMessage();

$activeUser = $userCursor->getActiveUsers($from_id);
