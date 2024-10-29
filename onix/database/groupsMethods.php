<?php

class GroupConnection extends Connection
{
    # ----------------- method for adding new user to database ------------------ #
    public function addNewGroup($chat_id)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_groups` (`chat_id`) VALUES (?)");
        $stmt->execute([$chat_id]);
    }
    # ----------------- method for getting all information about user ------------------ #
    public function getGroup($chat_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_groups` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return $stmt->fetch();
    }

    public function getGroupStatus($chat_id)
    {
        $stmt = $this->db->prepare("SELECT `is_active` FROM `tb_groups` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return $stmt->fetch();
    }

    public function setActive($chat_id , $number){
        $stmt = $this->db->prepare("UPDATE `tb_groups` SET `is_active` = ? WHERE `chat_id` = ? ");
        $stmt->execute([$number , $chat_id]);
    }
}