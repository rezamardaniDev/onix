<?php

$name = $response->result;

# -------------- price variables -------------- #

$dollar  = number_format($name->usd1);
$euro    = number_format($name->eur1);
$pond    = number_format($name->gbp1);
$lir     = number_format($name->try1);

$gerami  = number_format($name->gol18);
$sekee   = number_format($name->emami1);

// # -------------- creating inline keyboards for price section -------------- #

$sample = [];
$sample[] = [['text' => "{$dollar} تومان ", 'callback_data' => '0'], ['text' => "دلار آمریکا 🇺🇸", 'callback_data' => '0']];
$sample[] = [['text' => "{$euro} تومان ", 'callback_data' => '0'], ['text' => "یورو اروپا 🇪🇺", 'callback_data' => '0']];
$sample[] = [['text' => "{$pond} تومان ", 'callback_data' => '0'], ['text' => "پوند انگلیس 🏴󠁧󠁢󠁥󠁮󠁧󠁿󠁧󠁢󠁥󠁮󠁧󠁿", 'callback_data' => '0']];
$sample[] = [['text' => "{$lir} تومان ", 'callback_data' => '0'], ['text' => "لیر ترکیه 🇹🇷", 'callback_data' => '0']];

$sample[] = [['text' => 'نرخ سکه و طلا به شرح زیر می باشد', 'callback_data' => '0']];

$sample[] = [['text' => "{$gerami} تومان ", 'callback_data' => '0'], ['text' => "هر گرم طلا", 'callback_data' => '0']];
$sample[] = [['text' => "{$sekee} تومان ", 'callback_data' => '0'], ['text' => "سکه بهار آزادی", 'callback_data' => '0']];

$pricesKeyboard['inline_keyboard'] = $sample;
