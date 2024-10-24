<?php

function getRequest()
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://one-api.ir/rss/?token=947925:670026b59af4f&action=irinn",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET'
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}


var_dump(json_decode(getRequest())->result->item[0]);
var_dump(json_decode(getRequest())->result->item[0]->title);
var_dump(json_decode(getRequest())->result->item[0]->link);
var_dump(json_decode(getRequest())->result->item[0]->author);
var_dump(json_decode(getRequest())->result->item[0]->title);