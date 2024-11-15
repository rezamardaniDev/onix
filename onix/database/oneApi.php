<?php

class OneApi
{
    private $token;
    private $gpt3;
    private $gpt4;
    private $oneApiDomain = 'https://one-api.ir';
    private $senatorApiDomain = 'https://api.fast-creat.ir';
    private $hajiLicense = "yVuvnU4xxq0PZbdP0xBQ6UjvXM2dTSfllCsbRvg";


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

    # -------------- method for oghat sharie  -------------- #

    public function oghatSharie($city)
    {
        $url = "{$this->oneApiDomain}/owghat/?token={$this->token}&city={$city}&en_num=true";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    # -------------- method for crypto section  -------------- #

    public function crypto()
    {
        $url = "{$this->senatorApiDomain}/nobitex/v2?apikey=6317851077:XblkuwZFLCgMayI@Api_ManagerRoBot";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    public function arzDigital($tag)
    {
        $url = "https://haji-api.ir/bitpin/?search={$tag}&license={$this->hajiLicense}";
        $response = $this->getRequest($url);
        $data = json_decode($response)->result;
        return $data;
    }


    # -------------- method for translating text  -------------- #

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

    # -------------- method for logo creation  -------------- #

    public function makeLogo($name)
    {
        $url = "https://api3.haji-api.ir/majid/ai/ephoto/random?text={$name}&license={$this->hajiLicense}";
        $response = $this->getRequest($url);
        return json_decode($response)->result;
    }

    # -------------- method for Image creation  -------------- #

    public function aiPhoto($prompt)
    {
        $url = "https://api3.haji-api.ir/majid/ai/image/draw?p={$prompt}&license={$this->hajiLicense}";
        $response = $this->getRequest($url);
        $photo = json_decode($response);
        $link = $photo->result;
        return $link;
    }

    # -------------- method for sokhan bozorgan  -------------- #

    public function sokhan()
    {
        $url = "{$this->oneApiDomain}/sokhan/?token={$this->token}&action=random";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    # -------------- radioJavan method  -------------- #

    public function radioJavan($name)
    {
        $url = "{$this->oneApiDomain}/radiojavan/?token={$this->token}&action=search&q={$name}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    # -------------- radioJavan method  -------------- #

    public function textToVocieMan($text)
    {
        $url = "https://api3.haji-api.ir/majid/tools/tts?text={$text}&Character=FaridNeural&license={$this->hajiLicense}";
        $response = $this->getRequest($url);
        return json_decode($response)->result->url;
    }

    public function textToVocieWoMan($text)
    {
        $url = "https://api3.haji-api.ir/majid/tools/tts?text={$text}&Character=DilaraNeural&license={$this->hajiLicense}";
        $response = $this->getRequest($url);
        return json_decode($response)->result->url;
    }

    # -------------- method for getting weather  -------------- #

    public function getWhater($city)
    {
        $url = "https://api.codesazan.ir/Weather?key=6317851077:RCXp017ylga@CodeSazan_APIManager_Bot&type=Weather&city={$city}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    # -------------- method for getting music id -------------- #

    public function getSoundCloudId($link)
    {
        $url = "{$this->oneApiDomain}/soundcloud/?token={$this->token}&action=getid&link={$link}";
        $response = $this->getRequest($url);
        return json_decode($response)->result->id;
    }

    # -------------- method for getting music information -------------- #

    public function getSoundCloudInfo($id)
    {
        $url = "{$this->oneApiDomain}/soundcloud/?token={$this->token}&action=track&id={$id}";
        $response = $this->getRequest($url);
        return json_decode($response);
    }

    # -------------- method for downloading music -------------- #

    public function getSoundCloudFile($id)
    {
        $url = "{$this->oneApiDomain}/soundcloud/?token={$this->token}&action=download&id={$id}";
        $response = $this->getRequest($url);
        return $response;
    }

    # -------------- method for getting phone Price -------------- #

    public function getPriceOfPhone($tag)
    {
        $url = "{$this->oneApiDomain}/mobile/?token={$this->token}&action=search&q={$tag}";
        $phoneList = json_decode($this->getRequest($url))->result;

        $string = '';
        for ($i = 0; $i <= 5; $i++) {
            $string .= $phoneList[$i]->name . "\n" . $phoneList[$i]->price . "\n\n";
        }
        return $string;
    }

    public function getYoutubeId($link)
    {
        $url = "{$this->oneApiDomain}/youtube/?token={$this->token}&action=getvideoid&link={$link}";
        $response = $this->getRequest($url);
        return json_decode($response)->result;
    }

    public function getYoutubeDownloadId($id)
    {
        $url = "https://youtube.one-api.ir/?token={$this->token}&action=fullvideo&id={$id}";
        $response = $this->getRequest($url);
        return json_decode($response)->result->formats;
    }

    public function getYoutubeFile($id)
    {
        $url = "https://youtube.one-api.ir/?token={$this->token}&action=download&id={$id}";
        $response = $this->getRequest($url);
        return json_decode($response)->result->link;
    }

    public function instaDownloader($link)
    {
        $response = $this->postRequest("https://api.one-api.ir/instagram/v1/post/?shortcode={$link}", ['shortcode' => $link], ["one-api-token: {$this->token}"]);
        $link = json_decode($response)->result;
        return $link;
    }

    public function reserveBus($time, $mabda, $maghsad)
    {
        $url = "https://haji-api.ir/bus-ticket/?time={$time}&maghsad={$maghsad}&mabda={$mabda}&license={$this->hajiLicense}";
        $response = $this->getRequest($url);
        return json_decode($response)->buses;
    }
}
