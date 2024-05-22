<?php

use app\core\Application;

class m0002_add_projects
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE projects (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            description VARCHAR(255),
            deadline TIMESTAMP NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            user INT NOT NULL,
            FOREIGN KEY (user) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE projects;";
        $db->pdo->exec($sql);
    }
}