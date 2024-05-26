<?php

use app\core\Application;

class m0005_add_user_activation_hash
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "ALTER TABLE users ADD COLUMN activation_hash VARCHAR(64) DEFAULT NULL AFTER status, ADD UNIQUE (activation_hash);";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "ALTER TABLE users DROP COLUMN activation_hash;";
        $db->pdo->exec($sql);
    }
}