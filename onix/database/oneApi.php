<?php

class OneApi
{
    private $token;
    private $gpt3;
    private $gpt4;


    public function __construct($token)
    {
        $this->token = $token;
        $this->gpt3 = 'https://api.one-api.ir/chatbot/v1/gpt3.5-turbo/';
        $this->gpt4  = 'https://api.one-api.ir/chatbot/v1/gpt4o/';
    }

    public function postRequest($url, $data, $headers = [])
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array_merge(['Content-Type: application/json'], $headers),
        ]);


        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $response = 'Error: ' . curl_error($curl);
        }

        curl_close($curl);
        return $response;
    }


    public function sendTextToGpt($text, $type)
    {
        $ai_version = ($type === 'gpt-3') ? $this->gpt3 : (($type === 'gpt-4') ? $this->gpt4 : null);
        $response = $this->postRequest($ai_version, [["role" => "user", "content" => $text]], ["one-api-token: {$this->token}"]);
        return json_decode($response, true)['result'][0] ?? null;
    }

    public function getRequest($url, $action, $parametr = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://one-api.ir/{$url}/?token={$this->token}&action={$action}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);
        return $response;
    }
}
