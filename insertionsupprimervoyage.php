<?php
include("Connexion.php");
if (!empty($_GET["ig"])) {  
    $client=$_GET["ig"];
    $query = "DELETE FROM Voyages WHERE (IdVoyage) = (:ig)";
    var_dump($query);
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute([
        ":ig" => $_GET["ig"]
    ]);
    $pdostmt->closeCursor();
    if($pdostmt->rowCount() > 0){
        header("location:confirmationvoyagesup.php?etat=ok&ig=$client");
    }
    else{
        header("location:confirmationvoyagesup.php?etat=echec&ig=$client");
    }
   
}
?>