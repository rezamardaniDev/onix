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

    # -------------- method for all post requests -------------- #

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

    # -------------- method for calling the post request method and using the chat bot -------------- #

    public function sendTextToGpt($text, $type)
    {
        $ai_version = ($type === 'gpt-3') ? $this->gpt3 : (($type === 'gpt-4') ? $this->gpt4 : null);
        $response = $this->postRequest($ai_version, [["role" => "user", "content" => $text]], ["one-api-token: {$this->token}"]);
        return json_decode($response, true)['result'][0] ?? null;
    }

    # -------------- method for all get requests -------------- #

    public function getRequest($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL => $url,
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

    # -------------- method for getting news from get request method -------------- #

    public function getNews()
    {
        $url = "https://one-api.ir/rss/?token={$this->token}&action=irinn";
        $response = $this->getRequest($url);

        $botText = "اخبار روز : \n\n";
        for ($i = 0; $i < 10; $i++) {
            $botText = $botText . $i + 1 . ' :  <a href="' . json_decode($response)->result->item[$i]->link . '">' . json_decode($response)->result->item[$i]->title . '</a>' . "\n\n";
        }
        return $botText;
    }

    # -------------- method for getting all currency prices -------------- #

    public function getCurrency()
    {
        $url  = "https://one-api.ir/price/?token={$this->token}&action=tgju";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function falHafez()
    {
        $url = "https://one-api.ir/hafez/?token={$this->token}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function danestani()
    {
        $url = "https://one-api.ir/danestani/?token={$this->token}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }
}
