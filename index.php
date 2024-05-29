<?php

echo "coucou, je suis un code php dans une page HTML !";

$request="SHOW DATABASES";
$link = mysqli_connect('127.0.0.1', 'root', '') or die ('Error connecting to mysql: ' . mysqli_error($link).'\r\n');

$create_db = "CREATE DATABASE IF NOT EXISTS piel;";

mysqli_query($link, $create_db) or die ('Query failed: ' . mysqli_error($link).'\r\n');

$link = mysqli_connect('127.0.0.1', 'root', '', 'piel') or die ('Error connecting to mysql: ' . mysqli_error($link).'\r\n');

$create_table = "CREATE TABLE IF NOT EXISTS etudiants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(60) NOT NULL,
    date_naissance TIMESTAMP NOT NULL,
    classement INT NOT NULL
);";
$insert_row = "INSERT INTO etudiants (nom, date_naissance, classement) VALUES (\"piel\",\"2005-08-01\",10,), (\"enzo\",
\"2005-10-01\", 13), (\"john\",\"2005-01-01\",15);";

$delete_user = "DELETE FROM etudiants WHERE id=1;";
$update_user = "UPDATE etudiants SET date_naissance=\"1990-01-01\" WHERE id=2;";

mysqli_query($link, $create_table) or die ('Query failed: ' . mysqli_error($link).'\r\n');

mysqli_query($link, $insert_row) or die ('Query failed: ' . mysqli_error($link).'\r\n');

mysqli_query($link, $delete_user) or die ('Query failed: ' . mysqli_error($link).'\r\n');

mysqli_query($link, $update_user) or die ('Query failed: ' . mysqli_error($link).'\r\n');

?>