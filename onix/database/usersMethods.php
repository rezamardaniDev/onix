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
    public function setStep($chat_id, $input)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `step` = ? WHERE `chat_id` = ?");
        $stmt->execute([$input, $chat_id]);
    }
    # ----------------- method  for setting the admin ----------------- #
    public function setAdmin($chat_id)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `is_admin` = 1 WHERE `chat_id` = ?");
        $stmt->execute([$chat_id]);
    }
    # ----------------- method for deleting and admin ------------------ #
    public function deleteAdmin($chat_id)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `is_admin` = 0 WHERE `chat_id` = ?");
        $stmt->execute([$chat_id]);
    }
    # ----------------- method for setting the Ai type in database ------------------ #
    public function setAiType($chat_id, $input)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `ai_type` = ? WHERE `chat_id` = ?");
        $stmt->execute([$input, $chat_id]);
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
    public function setLimit($chat_id, $filed, $number)
    {
        $stmt = $this->db->prepare("UPDATE `tb_limits` SET $filed = ? WHERE `chat_id` = ? ");
        $stmt->execute([$number, $chat_id]);
    }

    public function addNewForceMessage($words)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_messages` (`question`, `answer`) VALUES (?, ?)");
        $stmt->execute($words);
    }

    public function getForceMessage($word)
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_messages` WHERE `question` LIKE ?");
        $stmt->execute(['%' . $word . '%']);
        $results = $stmt->fetchAll();
        $answers = array_column($results, 'answer');
        return !empty($answers) ? $answers[array_rand($answers)] : null;
    }

    public function deleteForceMessage($word)
    {
        $stmt = $this->db->prepare("DELETE FROM `tb_messages` WHERE `question` = '$word' ");
        $stmt->execute([$word]);
    }

    public function setPublicMessageUsers($chat_id, $text)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_public_message_users` (`chat_id` , `text`) VALUES (? , ?)");
        $stmt->execute([$chat_id, $text]);
    }

    public function setPublicMessageGroups($chat_id, $text)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_public_message_groups` (`chat_id` , `text`) VALUES (? , ?)");
        $stmt->execute([$chat_id, $text]);
    }

    public function getBotState()
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS `total` FROM `tb_users`");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result->total;
    }

    public function getGroupState()
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS `total` FROM `tb_groups`");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result->total;
    }


    public function banUser($chat_id)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `is_ban` = 1 WHERE `chat_id` = ?");
        $stmt->execute([$chat_id]);
    }
    # ----------------- method for deleting and admin ------------------ #
    public function unBanUser($chat_id)
    {
        $stmt = $this->db->prepare("UPDATE `tb_users` SET `is_ban` = 0 WHERE `chat_id` = ?");
        $stmt->execute([$chat_id]);
    }

    public function setChannel($username, $type)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_lock_channels` (`username`, `type`) VALUES (?, ?)");
        $stmt->execute([$username, $type]);
    }

    public function deleteChannel($username)
    {
        $stmt = $this->db->prepare("DELETE FROM `tb_lock_channels` WHERE `username` = ?");
        $stmt->execute([$username]);
    }

    public function getChannel($type)
    {
        $stmt = $this->db->prepare("SELECT `username` FROM `tb_lock_channels` WHERE `type` = ?");
        $stmt->execute([$type]);
        return  $stmt->fetchAll();
    }

    public function setForwardMessage($chat_id, $from_chat_id, $message_id, $type)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_public_forwards` (`chat_id`,`from_chat_id` , `message_id` , `type`) VALUES (?, ? , ? , ?)");
        $stmt->execute([$chat_id, $from_chat_id, $message_id, $type]);
    }

    public function getActiveUsers($chat_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `tb_active_users` WHERE `chat_id` = ? ");
        $stmt->execute([$chat_id]);
        return  $stmt->fetch();
    }

    public function setActiveUser($chat_id)
    {
        $stmt = $this->db->prepare("INSERT INTO `tb_active_users` (`chat_id`) VALUES (?)");
        $stmt->execute([$chat_id]);
    }
}
