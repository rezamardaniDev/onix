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


    public function getPrivateChnnels(){
        $stmt = $this->db->prepare("SELECT `username` FROM `tb_lock_channels` WHERE `type` = 'private'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSponsor(){
        $stmt = $this->db->prepare("SELECT `username` FROM `tb_lock_channels` WHERE `type` = 'sponsor'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLockGroup(){
        $stmt = $this->db->prepare("SELECT `username` FROM `tb_lock_channels` WHERE `type` = 'group'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getChannels($type){
        $stmt = $this->db->prepare("SELECT `username` FROM `tb_lock_channels` WHERE `type` = ?");
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }

    public function setLockChannel($chat_id , $type){
        $stmt = $this->db->prepare("INSERT INTO `tb_lock_channels` WHERE  `chat_id` = ? and `type` = ?");
        $stmt->execute([$chat_id , $type]);
    }

}