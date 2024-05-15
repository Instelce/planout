<?php
require_once('connexion_bdd.php');

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération des données du formulaire
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];

  // Préparation de la requête SQL d'insertion
  $sql = "INSERT INTO etudiants (nom, prenom, email, telephone) VALUES ('$nom', '$prenom', '$email', '$telephone')";

  // Exécution de la requête SQL
  if (mysqli_query($conn, $sql)) {
    echo "<p class='success'>Étudiant inscrit avec succès !</p>";
  } else {
    echo "<p class='error'>Erreur d'inscription de l'étudiant : " . mysqli_error($conn) . "</p>";
  }
}
