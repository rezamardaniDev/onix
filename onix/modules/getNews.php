<?php

$bot->sendChatAction($chat_id, 'typing');
$response = $apiRequest->getNews();
$bot->sendMessage($from_id, $response);