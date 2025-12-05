<?php
if (isset($_GET['etat'])){
    $Etat=$_GET['etat'];
    $client=$_GET['iv'];
    if ($Etat =='ok'){
        echo "<h3>Le client, ayant le code $client, a été supprimé avec succès !</h3>";
        header("Location:affuchagevols.php");
    }else{
        echo "<h3>Le Client, ayant le code $client, non trouvé !</h3>";
    }
}else{
    echo "<h3> Attention, ce script a besoin d'un parametre : etat de la suppreession !</h3>";
}
?>