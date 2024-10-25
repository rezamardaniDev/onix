<?php

$city         = $response->result->city;
$shahr        = "شهر انتخاب شده : {$city}\n\n";

$azan_sobh    = $response->result->azan_sobh;
$sob          = "🌑 اذان صبح : {$azan_sobh}\n\n";

$toloe_aftab  = $response->result->toloe_aftab;
$tloe         = "🌓 طلوع آفتاب : {$toloe_aftab}\n\n";

$azan_zohre   = $response->result->azan_zohre;
$zohr         = "🌕 اذان ظهر : {$azan_zohre}\n\n";

$ghorob_aftab = $response->result->ghorob_aftab;
$ghrob        = "🌗 غروب آفتاب : {$ghorob_aftab}\n\n";

$azan_maghreb = $response->result->azan_maghreb;
$mghreb       = "🌑 اذان مغرب : {$azan_maghreb}\n\n";

$nime_shabe_sharie = $response->result->nime_shabe_sharie;
$nimeShab     = "🌙 نیمه شب شرعی : {$nime_shabe_sharie}\n\n";
