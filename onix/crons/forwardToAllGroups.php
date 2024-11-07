<?php

include '../config/config.php';
include '../database/connector.php';
include '../utils/methods.php';

class PublicMessage extends Connection
{
    public function setSendMessage($id){
        $stmt = $this->db->prepare("UPDATE `tb_public_forwards` SET `send` = 1  WHERE `id` = ?");
        $stmt->execute([$id]);
    }

    public function selectMessage(){
        $stmt = $this->db->prepare("SELECT * FROM `tb_public_forwards` WHERE `send` = 0 AND `type` = 'groups'");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    public function getUsers($result1 , $bot){
        $stmt = $this->db->prepare("SELECT `chat_id` FROM `tb_groups` WHERE 1");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $key => $value) {

            $bot->forwardMessage($result1->from_chat_id , $result1->message_id , $value->chat_id);

        }
        $this->setSendMessage($result1->id);
    }
}
$pb = new PublicMessage();
$bot = new Bot(API_KEY);
$result = $pb->selectMessage();
$pb->getUsers($result , $bot);