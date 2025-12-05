<?php
include("Connexion.php");
if (!empty($_GET["ib"])) {  
    $client=$_GET["ib"];
    $query = "DELETE FROM Bateaux WHERE (IdBateau) = (:ib)";
    var_dump($query);
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute([
        ":ib" => $_GET["ib"]
    ]);
    $pdostmt->closeCursor();
    if($pdostmt->rowCount() > 0){
        header("location:confirmationbateausup.php?etat=ok&ib=$client");
    }
    else{
        header("location:confirmationbateausup.php?etat=echec&ib=$client");
    }
   
}
?>