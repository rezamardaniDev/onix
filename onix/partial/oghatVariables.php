<?php

$city         = $response->result->city;
$shahr        = "شهر انتخاب شده :  <b>{$city}</b>   {$response->result->month}/{$response->result->day}\n\n";

$azan_sobh    = $response->result->azan_sobh;
$sob          = "🌑  اذان صبح : <b>{$azan_sobh}</b>\n\n";

$toloe_aftab  = $response->result->toloe_aftab;
$tloe         = "🌓  طلوع آفتاب : <b>{$toloe_aftab}</b>\n\n";

$azan_zohre   = $response->result->azan_zohre;
$zohr         = "🌕  اذان ظهر : <b>{$azan_zohre}</b>\n\n";

$ghorob_aftab = $response->result->ghorob_aftab;
$ghrob        = "🌗  غروب آفتاب : <b>{$ghorob_aftab}</b>\n\n";

$azan_maghreb = $response->result->azan_maghreb;
$mghreb       = "🌑  اذان مغرب : <b>{$azan_maghreb}</b>\n\n";

$nime_shabe_sharie = $response->result->nime_shabe_sharie;
$nimeShab     = "🌙  نیمه شب شرعی : <b>{$nime_shabe_sharie}</b>\n\n";

