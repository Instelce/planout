<?php

use app\core\Application;

class m0004_add_kanban_management_tables
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE kanban_boards (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            project INT NOT NULL,
            FOREIGN KEY (project) REFERENCES projects(id) ON DELETE CASCADE
        ) ENGINE=INNODB;
        CREATE TABLE kanban_columns (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            kanban_board INT NOT NULL,
            FOREIGN KEY (kanban_board) REFERENCES kanban_boards(id) ON DELETE CASCADE
        ) ENGINE=INNODB;
        CREATE TABLE kanban_cards (
            id INT AUTO_INCREMENT PRIMARY KEY,
            content VARCHAR(255) NOT NULL,
            kanban_column INT NOT NULL,
            FOREIGN KEY (kanban_column) REFERENCES kanban_columns(id) ON DELETE CASCADE
        ) ENGINE=INNODB;
        CREATE TABLE kanban_card_attributions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            kanban_card INT NOT NULL,
            member INT NOT NULL,
            FOREIGN KEY (kanban_card) REFERENCES kanban_cards(id),
            FOREIGN KEY (member) REFERENCES members(id)
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE kanban_boards;
        DROP TABLE kanban_columns;
        DROP TABLE kanban_cards;
        DROP TABLE kanban_card_attributions;";
        $db->pdo->exec($sql);
    }
}