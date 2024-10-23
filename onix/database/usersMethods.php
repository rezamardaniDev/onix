<?php


class UserConnection extends Connection
{
    public function addNewUser($chat_id)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_users` (`chat_id`, `step`) VALUES (? , ?)");
        $stmt->execute([$chat_id, 'home']);
    }

    public function getUser($chat_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_users` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return $stmt->fetch();
    }

    public function setStep($chat_id , $input)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `step` = ? WHERE `chat_id` = ?");
        $stmt->execute([$input , $chat_id]);
    }

    public function setAiType($chat_id , $input)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `ai_type` = ? WHERE `chat_id` = ?");
        $stmt->execute([$input , $chat_id]);
    }

    public function getLimits($chat_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_limits` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return $stmt->fetch();
    }

    public function setGpt3Limit($chat_id)
    {
        $stmt = $this->db->prepare("UPDATE `tb_limits` SET `gpt_3_limit` = 20 WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
    }

    public function setGpt4Limit($chat_id)
    {
        $stmt = $this->db->prepare("UPDATE `tb_limits` SET `gpt_4_limit` = 10 WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
    }
}
