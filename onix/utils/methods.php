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

    public function sendMessage($chat_id, $text, $keyboard = null, $mrk = 'HTML', $message_id = null)
    {
        $params = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => $mrk,
            'disable_web_page_preview' => true,
            'reply_markup' => $keyboard,
            'reply_to_message_id' => $message_id
        ];
        return $this->TelegramRequest('sendMessage', $params);
    }

    public function editMessage($chat_id, $text, $message_id, $keyboard = null, $mrk = 'HTML')
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

    public function sendPhoto($chat_id, $photo, $caption, $keyboard = null)
    {
        return $this->TelegramRequest('sendPhoto', [
            'chat_id' => $chat_id,
            'photo'   => $photo,
            'caption' => $caption,
            'parse_mode' => 'HTML',
            'reply_markup' => $keyboard
        ]);
    }

    public function sendVideo($chat_id, $photo, $caption = null, $keyboard = null)
    {
        return $this->TelegramRequest('sendVideo', [
            'chat_id' => $chat_id,
            'video'   => $photo,
            'caption' => $caption,
            'parse_mode' => 'HTML',
            'reply_markup' => $keyboard
        ]);
    }

    public function sendAudio($chat_id, $audio, $caption = null, $keyboard = null)
    {
        return $this->TelegramRequest('sendAudio', [
            'chat_id' => $chat_id,
            'audio'   => $audio,
            'caption' => $caption,
            'parse_mode' => 'HTML',
            'reply_markup' => $keyboard
        ]);
    }

    public function sendChatAction($chat_id, $action)
    {
        return $this->TelegramRequest('sendChatAction', [
            'chat_id' => $chat_id,
            'action'  => $action
        ]);
    }

    function convertFaToEn($number)
    {
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '.'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'];
        $changed = str_replace($persianNumbers, $englishNumbers, $number);

        return $changed;
    }

    public function getChatMember($chat_id , $user_id){
        return $this->TelegramRequest('getChatMember', [
            'chat_id' => $chat_id,
            'user_id'   => $user_id
        ]);
    }

    public function forwardMessage($from_chat_id , $message_id , $chat_id){
        return $this->TelegramRequest('forwardMessage' ,[
            'from_chat_id' => $from_chat_id,
            'message_id' => $message_id,
            'chat_id' => $chat_id
        ]);
    }
    public function debug($data)
    {
        $result = print_r($data, true);
        return $this->sendMessage(5910225814, $result);
    }
}
