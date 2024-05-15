<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription et liste des étudiants</title>
</head>
<body>
<h1>Gestion des étudiants</h1>

<section id="inscription">
    <h2>Inscription</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" required><br><br>

        <button type="submit" name="submit">Inscrire</button>
    </form>
</section>

<section id="nb-etudiants">
    <h2>Nombre d'étudiants inscrits</h2>
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
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        // Arrêter l'exécution du script si la connexion échoue
        die();
    }

    // Requête SQL pour compter les étudiants
    $sql_count = "SELECT COUNT(*) FROM etudiants";
    $stmt_count = $conn->query($sql_count);
    $total_students = $stmt_count->fetchColumn();

    echo "<p>Nombre d'étudiants inscrits : $total_students</p>";

    // Fermeture de la connexion à la base de données
    $conn = null;
    ?>
</section>

<?php include('liste_etudiants.php'); ?>

</body>
</html>
