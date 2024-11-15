<?php

flush();
ob_start();
ob_implicit_flush(1);
ini_set("expose_php", "Off");
ini_set("Allow_url_fopen", "Off");
ini_set("disable_functions", "exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source,eval,file,file_get_contents,file_put_contents,fclose,fopen,fwrite,mkdir,rmdir,unlink,glob,echo,die,exit,print,scandir");
ini_set("max_execution_time", "25");
ini_set("max_input_time", "25");
ini_set("memory_limit", "15M");
ini_set("file_uploads", "Off");
ini_set("post_max_size", "10k");
error_reporting(0);
ini_set("log_errors", "Off");
ignore_user_abort(true);


$telegram_ip_ranges = [

    ['lower' => '149.154.160.0', 'upper' => '149.154.175.255'],

    ['lower' => '91.108.4.0', 'upper' => '91.108.7.255'],

];

$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));

$ok = false;

foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {

    $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));

    $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));

    if ($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok = true;
}
if (!$ok) die();



if (
    strpos($text, '}') !== false ||
    strpos($text, '"') !== false ||
    strpos($text, '\'') !== false ||
    strpos($text, '{') !== false ||
    strpos($text, '[') !== false ||
    strpos($text, ']') !== false ||
    strpos($text, '=>') !== false ||
    strpos($text, '((') !== false ||
    strpos($text, 'function') !== false ||
    strpos($text, 'CURL') !== false ||
    strpos($text, 'sql') !== false
) {
    $bot->sendMessage($from_id, "<b>خطا در پردازش !</b>\nبه دلایل مسائل امنیتی، ارسال کد به ربات مجاز نمیباشد.", message_id:$message_id);
    die;
}
