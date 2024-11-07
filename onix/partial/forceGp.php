<?php

$sponsorKeyboard = [
    'inline_keyboard' => []
];
$result = $userCursor->getChannel('sponsor');
$sample = [];

foreach ($result as $key => $value) {
    $sample[] = [['text' => $value->username, 'url' => "https://t.me/{$value->username}"]];
}

$sponsorKeyboard['inline_keyboard'] = $sample;