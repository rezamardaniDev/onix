<?php


class UserConnection extends Connection
{
    public function addNewUser($chat_id)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_users` (`chat_id`) VALUES (? , ?)");
        $stmt->execute([$chat_id, 'home']);
    }

    public function getUser($chat_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_users` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return $stmt->fetch();
    }

    public function getStep($chat_id)
    {
        $stmt = $this->db->prepare("SELECT `step` FROM `tb_users` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return $stmt->fetch()->step;
    }
}
