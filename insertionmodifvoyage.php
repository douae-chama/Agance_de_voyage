<?php
include("connexion.php");

if (!empty($_POST["ig"]) && !empty($_POST["titre"]) && !empty($_POST["description"]) && !empty($_POST["prix"]) && !empty($_POST["datedepart"]) && !empty($_POST["dateretour"]) && !empty($_POST["destination"])) {
    
    // Variables POST
    $idVoyage = $_POST["ig"];
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $dateDepart = $_POST["datedepart"];
    $dateRetour = $_POST["dateretour"];
    $destination = $_POST["destination"];
 $imageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/"; 
        $imageName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
    }
    // Préparer la requête de mise à jour
    $query = "UPDATE Voyages SET 
                Titre = :titre,
                Description = :description,
                Prix = :prix,
                DateDepart = :datedepart,
                DateRetour = :dateretour,
                Destination = :destination";
        if ($imageName !== null) {
        $query .= ", image = :image";
    }         
                 $query .= " WHERE IdVoyage = :ig";

    // Préparer et exécuter la requête
    $pdostmt = $connexion->prepare($query);
    
    $params = [
        "ig" => $idVoyage,
        "titre" => $titre,
        "description" => $description,
        "prix" => $prix,
        "datedepart" => $dateDepart,
        "dateretour" => $dateRetour,
        "destination" => $destination
    ];
if ($imageName !== null) {
        $params["image"] = $imageName;
    }
    $pdostmt->execute($params);
    $pdostmt->closeCursor();

    // Rediriger après la mise à jour
    header("Location: affichagevoyage.php");
    exit();
} else {
    echo "Tous les champs obligatoires ne sont pas remplis.";
}
?>
