<?php

include '../config/config.php';
include '../database/connector.php';
include '../utils/methods.php';

class PublicMessage extends Connection
{
    public function setSendMessage($id)
    {
        $stmt = $this->db->prepare("UPDATE `tb_public_message_groups` SET `send` = 1  WHERE `id` = ?");
        $stmt->execute([$id]);
    }

    public function selectMessage()
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_public_message_groups` WHERE `send` = 0");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    public function getGroups($text, $bot)
    {
        $stmt = $this->db->prepare("SELECT `chat_id` FROM `tb_groups` WHERE 1");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $key => $value) {

            $bot->sendMessage($value->chat_id, $text->text);
        }
        $this->setSendMessage($text->id);
    }
}
$pb = new PublicMessage();
$bot = new Bot(API_KEY);
$result = $pb->selectMessage();
$pb->getGroups($result, $bot);
