<?php

include '../database/connector.php';


class Resets extends Connection
{
    public function resetLimits()
    {
        $stmt = $this->db->prepare("UPDATE `tb_limits` SET `gpt_3_limit` = 20 ,`gpt_4_limit` = 10 WHERE 1");
        $stmt->execute();
    }
}

$resetCursor = new Resets();
$resetCursor->resetLimits();