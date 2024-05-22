<?php

use app\core\Application;

class m0003_add_members
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE members (
            id INT AUTO_INCREMENT PRIMARY KEY,
            role VARCHAR(60) NOT NULL,
            job VARCHAR(60) NOT NULL,
            project INT NOT NULL,
            user INT NOT NULL,
            FOREIGN KEY (project) REFERENCES projects(id) ON DELETE CASCADE,
            FOREIGN KEY (user) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE members;";
        $db->pdo->exec($sql);
    }
}