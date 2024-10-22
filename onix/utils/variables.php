<?php

if (isset($update->message)) {
    $message = $update->message;
    $text    = $message->text;
    $from_id = $message->from->id;
    $first_name = $message->from->first_name;
    $chat_id = $message->chat->id;
    $first_name = htmlspecialchars($message->from->first_name, ENT_QUOTES, 'UTF-8');
    $message_id  = $update->message->message_id;
    $group_name  = $message->chat->title;
    $join_member = $message->new_chat_participant;
    $left_member = $message->left_chat_participant;
    $new_member_name = $join_member->first_name;
    $left_member_name = $left_member->first_name;
    $participant_id = $join_member->id;
    $participant_first_name = $join_member->first_name;
}

if (isset($update->callback_query)) {
    $callback_id = $update->callback_query->id;
    $from_id     = $update->callback_query->from->id;
    $data        = $update->callback_query->data;
    $query_id    = $update->callback_query->id;
    $type        = $update->callback_query->message->chat->type;
    $message_id  = $update->callback_query->message->message_id;
}
