<?php

include '../database/connector.php';


class Resets extends Connection
{
    public function resetLimits()
    {
        $stmt = $this->db->prepare("UPDATE `tb_limits` SET `gpt_3_limit` = 20 ,`gpt_4_limit` = 10, `image_limit` = 10 , `logo_limit` = 10, `text_to_voice` = 10 , `search_music` = 10 , `dl_instagram` = 10 , `dl_spotify` = 10 , `dl_soundcloud` = 10 , `dl_youtube` = 10 WHERE 1");
        $stmt->execute();
    }
}

$resetCursor = new Resets();
$resetCursor->resetLimits();