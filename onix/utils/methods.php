<?php

# -------------- Bot class for Request To Telegram -------------- #

class Bot
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    function TelegramRequest(string $method, array $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->apiKey . '/' . $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        return json_decode($response);
    }

    public function sendMessage($chat_id, $text, $keyboard = null, $mrk = 'HTML')
    {
        $params = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => $mrk,
            'disable_web_page_preview' => true,
            'reply_markup' => $keyboard
        ];
        return $this->TelegramRequest('sendMessage', $params);
    }

    public function editMessage($chat_id, $text, $message_id, $keyboard = null, $mrk = 'html')
    {
        $params = [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => $text,
            'parse_mode' => $mrk,
            'reply_markup' => $keyboard
        ];
        return $this->TelegramRequest('editMessageText', $params);
    }

    public function deleteMessages($chat_id, $message_id)
    {
        return $this->TelegramRequest('deleteMessage', [
            'chat_id'     => $chat_id,
            'message_id'  => $message_id
        ]);
    }

    public function sendChatAction($chat_id, $action)
    {
        return $this->TelegramRequest('sendChatAction', [
            'chat_id' => $chat_id,
            'action'  => $action
        ]);
    }

    public function debug($data)
    {
        $result = print_r($data, true);
        $this->sendMessage(-1002448733523, $result);
    }
}
