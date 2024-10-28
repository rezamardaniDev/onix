<?php
if ($text == '「 🌦 آب و  هوا 」') {
    $bot->sendMessage($from_id, "برای استفاده از این قابلیت در گروه یا پیوی به صورت زیر عمل کنید\n\nهوا + نام شهر\nبرای مثال: هوا شیراز", $backButton);
    die;
}
$bot->sendChatAction($chat_id, 'typing');

$response = $apiRequest->getWhater(explode(' ', $text, 2)[1]);

if ($response->status != 200) {
    $bot->sendMessage($chat_id, 'شهر مورد نظر یافت نشد!');
    die;
}

$country      = $response->result->country;
$state        = $response->result->state;
$weather_cond = $response->result->weather_conditions;
$degree       = $response->result->degree;
$speed        = $response->result->speed;
$humidity     = $response->result->humidity;

$botMessage = "
🌎| کشور: $country
📍| استان: $state
☁️| وضعیت هوا: $weather_cond
❄️| دمای هوا️: $degree
🌪️| سرعت وزش باد️: $speed
🚿| رطوبت هوا️: $humidity
";

$bot->sendMessage($chat_id, $botMessage, message_id: $message_id);
die;
