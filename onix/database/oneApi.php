<?php

class OneApi
{
    private $token;
    private $gpt3 = 'https://api.one-api.ir/chatbot/v1/gpt3.5-turbo/';
    private $gpt4 = 'https://api.one-api.ir/chatbot/v1/gpt4o/';


    public function __construct($token)
    {
        $this->token = $token;
    }

    public function sendTextToGpt($text, $type)
    {
        $ai_version = ($type === 'gpt-3') ? $this->gpt3 : (($type === 'gpt-4') ? $this->gpt4 : null);

        // آماده‌سازی درخواست cURL
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $ai_version,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, // تنظیم یک timeout معقول
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                [
                    "role" => "user",
                    "content" => $text
                ]
            ]),
            CURLOPT_HTTPHEADER => [
                "one-api-token: {$this->token}",
                'Content-Type: application/json'
            ],
        ]);

        // اجرای درخواست و دریافت پاسخ
        $response = curl_exec($curl);

        // خطایابی cURL
        if (curl_errno($curl)) {
            $response = 'Error: ' . curl_error($curl); // در صورت بروز خطا
        }

        curl_close($curl);
        return json_decode($response, true)['result'][0];
    }
}
