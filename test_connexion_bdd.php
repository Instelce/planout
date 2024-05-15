<?php

// Informations de connexion à la base de données
$db_host = "sql113.infinityfree.com"; // Hostname of the database server
$db_user = "if0_36552963"; // Username for database access
$db_pass = "Q1MAbdqY9w"; // Password for database access (replace with actual password)
$db_name = "if0_36552963_db"; // Database name (replace with actual database name)

// Tenter la connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à la base de données réussie !";
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
