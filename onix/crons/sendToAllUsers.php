<?php

include '../config/config.php';
include '../database/connector.php';
include '../utils/methods.php';

class PublicMessage extends Connection
{
    public function setSendMessage($id){
        $stmt = $this->db->prepare("UPDATE `tb_public_message_users` SET `send` = 1  WHERE `id` = ?");
        $stmt->execute([$id]);
    }

    public function selectMessage(){
        $stmt = $this->db->prepare("SELECT * FROM `tb_public_message_users` WHERE `send` = 0");
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
        $bot->sendMessage($text->chat_id, 'پیام شما با موفقیت به تمام اعضای ربات ارسال گردید.');
    }
}
$pb = new PublicMessage();
$bot = new Bot(API_KEY);
$result = $pb->selectMessage();
$pb->getUsers($result , $bot);