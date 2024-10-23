<?php


class UserConnection extends Connection
{
    # ----------------- method for adding new user to database ------------------ #
    public function addNewUser($chat_id)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_users` (`chat_id`, `step`) VALUES (? , ?)");
        $stmt->execute([$chat_id, 'home']);
    }

    # ----------------- method for getting all information about user ------------------ #
    public function getUser($chat_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_users` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return $stmt->fetch();
    }

    # ----------------- method for setting step of user in database ------------------ #
    public function setStep($chat_id , $input)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `step` = ? WHERE `chat_id` = ?");
        $stmt->execute([$input , $chat_id]);
    }

    # ----------------- method for setting the Ai type in database ------------------ #
    public function setAiType($chat_id , $input)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `ai_type` = ? WHERE `chat_id` = ?");
        $stmt->execute([$input , $chat_id]);
    }

    # ----------------- method for adding new userLimits to database ------------------ #
    public function addNewUserLimits($chat_id)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_limits` (`chat_id`) VALUES (?)");
        $stmt->execute([$chat_id]);
    }

    # ----------------- method for getting all limits of user ------------------ #
    public function getLimits($chat_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_limits` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return $stmt->fetch();
    }

    # ----------------- method for setting GPT 3 in database ------------------ #
    public function setGpt3Limit($chat_id , $number)
    {
        $stmt = $this->db->prepare("UPDATE `tb_limits` SET `gpt_3_limit` = ? WHERE `chat_id` = ? ");
        $stmt->execute([$number , $chat_id]);
    }

    # ----------------- method for setting GPT 4 in database ------------------ #
    public function setGpt4Limit($chat_id , $number)
    {
        $stmt = $this->db->prepare("UPDATE `tb_limits` SET `gpt_4_limit` = ? WHERE `chat_id` = ? ");
        $stmt->execute([$number , $chat_id]);
    }
}
