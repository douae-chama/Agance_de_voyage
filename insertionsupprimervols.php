<?php
include("Connexion.php");
if (!empty($_GET["iv"])) {  
    $client=$_GET["iv"];
    $query = "DELETE FROM Vols WHERE (IdVol) = (:iv)";
    var_dump($query);
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute([
        ":iv" => $_GET["iv"]
    ]);
    $pdostmt->closeCursor();
    if($pdostmt->rowCount() > 0){
        header("location:confirmationvolsup.php?etat=ok&iv=$client");
    }
    else{
        header("location:confirmationvolsup.php?etat=echec&iv=$client");
    }
   
}
?>