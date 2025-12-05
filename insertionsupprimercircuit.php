<?php
include("Connexion.php");
if (!empty($_GET["ic"])) {  
    $client=$_GET["ic"];
    $query = "DELETE FROM Circuits WHERE (IdCircuit) = (:ic)";
    var_dump($query);
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute([
        ":ic" => $_GET["ic"]
    ]);
    $pdostmt->closeCursor();
    if($pdostmt->rowCount() > 0){
        header("location:confirmationcircuitsup.php?etat=ok&ic=$client");
    }
    else{
        header("location:confirmationcircuitsup.php?etat=echec&ic=$client");
    }
   
}
?>