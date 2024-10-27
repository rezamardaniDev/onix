<?php

$response = $apiRequest->getWhater(explode(' ', $text, 2)[1]);

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

$bot->sendMessage($from_id, $botMessage);
die;