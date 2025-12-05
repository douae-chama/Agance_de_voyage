<?php
include 'connexion.php';
if(
    !empty($_POST["nom"])&&
    !empty($_POST["prenom"])&&
    !empty($_POST["telephone"])&&
    !empty($_POST["adresse"])
   )
{
    $query="insert into Administrateur(Nom,Prenom,telephone, Adresse)values(:nom,:prenom,:telephone,:adresse)";
    var_dump($query);
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute([
        "nom"=>$_POST["nom"],
        "prenom"=>$_POST["prenom"],
        "telephone"=>$_POST["telephone"],
        "adresse"=>$_POST["adresse"]]);
    $pdostmt->closeCursor();
    header("Location:utilisateursadmin.php");} 
?>