<?php
// Informations de connexion à la base de données
$db_host = "sql113.infinityfree.com"; // Nom d'hôte du serveur de base de données
$db_user = "if0_36552963"; // Nom d'utilisateur pour l'accès à la base de données
$db_pass = "Q1MAbdqY9w"; // Mot de passe pour l'accès à la base de données (remplacez par le mot de passe réel)
$db_name = "if0_36552963_db"; // Nom de la base de données (remplacez par le nom de la base de données réelle)

// Tenter la connexion à la base de données
try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion à la base de données réussie !"; // Cette ligne est supprimée
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
