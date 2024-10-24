<?php

$name = $response->result;

$dollar = number_format(intval(str_replace(",", "", $name->currencies->dollar->p)) / 10, 0, '.', ',');
$euro = number_format(intval(str_replace(",", "", $name->currencies->eur->p)) / 10, 0, '.', ',');
$derham = number_format(intval(str_replace(",", "", $name->currencies->aed->p)) / 10, 0, '.', ',');
$pond = number_format(intval(str_replace(",", "", $name->currencies->gbp->p)) / 10, 0, '.', ',');
$lir = number_format(intval(str_replace(",", "", $name->currencies->try->p)) / 10, 0, '.', ',');
$caDollar = number_format(intval(str_replace(",", "", $name->currencies->cad->p)) / 10, 0, '.', ',');

$gerami = number_format(intval(str_replace(",", "", $name->coin->gerami->p)) / 10, 0, '.', ',');
$rob = number_format(intval(str_replace(",", "", $name->coin->rob->p)) / 10, 0, '.', ',');
$nim = number_format(intval(str_replace(",", "", $name->coin->nim->p)) / 10, 0, '.', ',');
$sekeb = number_format(intval(str_replace(",", "", $name->coin->sekeb->p)) / 10, 0, '.', ',');
$sekee = number_format(intval(str_replace(",", "", $name->coin->sekee->p)) / 10, 0, '.', ',');


$sample = [];
$sample[] = [['text' => "{$dollar} تومان ", 'callback_data' => '0'], ['text' => "دلار آمریکا 🇺🇸", 'callback_data' => '0']];
$sample[] = [['text' => "{$euro} تومان ", 'callback_data' => '0'], ['text' => "یورو اروپا 🇪🇺", 'callback_data' => '0']];
$sample[] = [['text' => "{$derham} تومان ", 'callback_data' => '0'], ['text' => "درهم امارات 🇦🇪", 'callback_data' => '0']];
$sample[] = [['text' => "{$pond} تومان ", 'callback_data' => '0'], ['text' => "پوند انگلیس 󠁧󠁢󠁥󠁮󠁧󠁿", 'callback_data' => '0']];
$sample[] = [['text' => "{$lir} تومان ", 'callback_data' => '0'], ['text' => "لیر ترکیه 🇹🇷", 'callback_data' => '0']];
$sample[] = [['text' => "{$caDollar} تومان ", 'callback_data' => '0'], ['text' => "دلار کانادا 🇨🇦", 'callback_data' => '0']];

$sample[] = [['text' => 'نرخ سکه و طلا به شرح زیر می باشد', 'callback_data' => '0']];

$sample[] = [['text' => "{$gerami} تومان ", 'callback_data' => '0'], ['text' => "سکه گرمی", 'callback_data' => '0']];
$sample[] = [['text' => "{$rob} تومان ", 'callback_data' => '0'], ['text' => "ربع سکه", 'callback_data' => '0']];
$sample[] = [['text' => "{$nim} تومان ", 'callback_data' => '0'], ['text' => "نیم سکه", 'callback_data' => '0']];
$sample[] = [['text' => "{$sekeb} تومان ", 'callback_data' => '0'], ['text' => "سکه بهار آزادی", 'callback_data' => '0']];
$sample[] = [['text' => "{$sekee} تومان ", 'callback_data' => '0'], ['text' => "سکه امامی", 'callback_data' => '0']];
