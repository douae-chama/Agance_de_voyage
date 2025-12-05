<?php
session_start();
include 'connexion.php';

if (
    !empty($_POST["nom"]) &&
    !empty($_POST["prenom"]) &&
    !empty($_POST["telephone"]) &&
    !empty($_POST["adresse"])
) {
    $query = "INSERT INTO Clients (Nom, Prenom, telephone, Adresse)
              VALUES (:nom, :prenom, :telephone, :adresse)";
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute([
        "nom" => $_POST["nom"],
        "prenom" => $_POST["prenom"],
        "telephone" => $_POST["telephone"],
        "adresse" => $_POST["adresse"]
    ]);$pdostmt->closeCursor();
     $lastId = $connexion->lastInsertId();
    $_SESSION['IdClient'] = $lastId;

    
    
    header("Location: utilisateurclient.php");
    exit();
}
?>