<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <style>
        .student-list {
            margin-top: 20px;
        }

        .student-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-list th, .student-list td {
            padding: 8px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
<h1>Liste des étudiants</h1>

<section class="student-list">
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

    // Requête SQL pour récupérer les étudiants
    $sql_students = "SELECT * FROM etudiants";
    $stmt_students = $conn->query($sql_students);
    $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

    if ($students) {
        echo '<table>';
        echo '<tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th></tr>';
        foreach ($students as $student) {
            echo '<tr>';
            echo '<td>' . $student['nom'] . '</td>';
            echo '<td>' . $student['prenom'] . '</td>';
            echo '<td>' . $student['email'] . '</td>';
            echo '<td>' . $student['telephone'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "<p>Aucun étudiant trouvé.</p>";
    }

    // Fermeture de la connexion à la base de données
    $conn = null;
    ?>
</section>

</body>
</html>
