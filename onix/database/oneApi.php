<?php

class OneApi
{
    private $token;
    private $gpt3;
    private $gpt4;
    private $oneApiDomain = 'https://one-api.ir';
    private $senatorApiDomain = 'https://api.fast-creat.ir';


    public function __construct($token)
    {
        $this->token = $token;
        $this->gpt3  = 'https://api.one-api.ir/chatbot/v1/gpt3.5-turbo/';
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
        $url = "{$this->oneApiDomain}/rss/?token={$this->token}&action=irinn";
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
        $url  = "{$this->oneApiDomain}/price/?token={$this->token}&action=bonbast";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    # -------------- method for getting all funny text  -------------- #

    public function funnyService($parametr)
    {
        $url = "{$this->oneApiDomain}/{$parametr}/?token={$this->token}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function oghatSharie($city)
    {
        $url = "{$this->oneApiDomain}/owghat/?token={$this->token}&city={$city}&en_num=true";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function crypto()
    {
        $url = "{$this->senatorApiDomain}/nobitex/v2?apikey=6317851077:XblkuwZFLCgMayI@Api_ManagerRoBot";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function translateToEn($text)
    {
        $url = "{$this->oneApiDomain}/translate/?token={$this->token}&action=google&lang=en&q=$text";
        $response = $this->getRequest($url);
        return json_decode($response)->result;
    }

    public function translateToFa($text)
    {
        $url = "{$this->oneApiDomain}/translate/?token={$this->token}&action=google&lang=fa&q=$text";
        $response = $this->getRequest($url);
        return json_decode($response)->result;
    }

    public function makeLogo($name)
    {
        $randomLogo = mt_rand(1, 140);
        $logo = "{$this->senatorApiDomain}/logo/?apikey=6317851077:PQpi8V12DEJtw3K@Api_ManagerRoBot&type=logo&id={$randomLogo}&text={$name}";
        return $logo;
    }

    public function aiPhoto($prompt)
    {
        $url = "{$this->senatorApiDomain}/gpt/pic?apikey=6317851077:9sn8DBCSo0zIwly@Api_ManagerRoBot&text={$prompt}";
        $response = $this->getRequest($url);
        $photo = json_decode($response);
        $link = $photo->result->image;
        $correctedLink = str_replace("\\", "", $link);
        return $correctedLink;
    }

    public function sokhan()
    {
        $url = "{$this->oneApiDomain}/sokhan/?token={$this->token}&action=random";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function radioJavan($name)
    {
        $url = "{$this->oneApiDomain}/radiojavan/?token={$this->token}&action=search&q={$name}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function textToVocieMan($text)
    {
        $url = "{$this->oneApiDomain}/tts/?token={$this->token}&action=microsoft&lang=fa-IR-FaridNeural&q={$text}";
        $response = $this->getRequest($url);
        return $response;
    }

    public function textToVocieWoMan($text)
    {
        $url = "{$this->oneApiDomain}/tts/?token={$this->token}&action=microsoft&lang=fa-IR-DilaraNeural&q={$text}";
        $response = $this->getRequest($url);
        return $response;
    }

    public function getWhater($city)
    {
        $url = "https://api.codesazan.ir/Weather?key=6317851077:RCXp017ylga@CodeSazan_APIManager_Bot&type=Weather&city={$city}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function getSoundCloudId($link)
    {
        $url = "{$this->oneApiDomain}/soundcloud/?token={$this->token}&action=getid&link={$link}";
        $response = $this->getRequest($url);
        return json_decode($response)->result->id;
    }

    public function getSoundCloudInfo($id)
    {
        $url = "{$this->oneApiDomain}/soundcloud/?token={$this->token}&action=track&id={$id}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function getSoundCloudFile($id)
    {
        $url = "{$this->oneApiDomain}/soundcloud/?token={$this->token}&action=download&id={$id}";
        $response = $this->getRequest($url);
        return $response;
    }
}
