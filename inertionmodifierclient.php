<?php
include("Connexion.php");
if( !empty($_POST["id"])&&
    !empty($_POST["nom"])&&
    !empty($_POST["prenom"])&&
    !empty($_POST["telephone"])&&
    !empty($_POST["adress"]))
{  
    $client=$_POST["id"];
    $query = "UPDATE Clients SET Nom=:nom,Prenom=:prenom,telephone=:telephone,Adresse=:adress WHERE IdClient = :id";
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute([
        "id"=>$_POST["id"],
        "nom"=>$_POST["nom"],
        "prenom"=>$_POST["prenom"],
        "telephone"=>$_POST["telephone"],
        "adress"=>$_POST["adress"]]);
    $pdostmt->closeCursor();
    $client = $pdostmt->fetch(PDO::FETCH_ASSOC);
    header("location:affichageclient.php");
}

?>