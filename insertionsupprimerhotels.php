<?php
include("Connexion.php");
if (!empty($_GET["ih"])) {  
    $client=$_GET["ih"];
    $query = "DELETE FROM Hotels WHERE (IdHotel) = (:ih)";
    var_dump($query);
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute([
        ":ih" => $_GET["ih"]
    ]);
    $pdostmt->closeCursor();
    if($pdostmt->rowCount() > 0){
        header("location:confirmationhotelsup.php?etat=ok&ih=$client");
    }
    else{
        header("location:confirmationhotelsup.php?etat=echec&ih=$client");
    }
   
}
?>