<?php

include '../config/config.php';
include '../database/connector.php';
include '../utils/methods.php';

class Resets extends Connection
{
    public function resetLimits()
    {
        $stmt = $this->db->prepare("UPDATE `tb_limits` SET `gpt_3_limit` = 20 ,`gpt_4_limit` = 10, `image_limit` = 10 , `logo_limit` = 10, `text_to_voice` = 10 , `search_music` = 10 , `dl_instagram` = 10 , `dl_soundcloud` = 10 , `dl_youtube` = 10 WHERE 1");
        $stmt->execute();
    }
    public function setSendMessage($id){
        $stmt = $this->db->prepare("UPDATE `tb_public_message` SET `send` = 1  WHERE `id` = ?");
        $stmt->execute([$id]);
    }

    public function selectMessage(){
        $stmt = $this->db->prepare("SELECT * FROM `tb_public_message` WHERE `send` = 0");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    public function getUsers($text , $bot){
        $stmt = $this->db->prepare("SELECT `chat_id` FROM `tb_users` WHERE 1");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $key => $value) {

            $bot->sendMessage($value->chat_id , $text->text);

        }
        $this->setSendMessage($text->id);
    }
}

$resetCursor = new Resets();
$bot = new Bot(API_KEY);
$resetCursor->resetLimits();
$result = $resetCursor->selectMessage();
$resetCursor->getUsers($result , $bot);