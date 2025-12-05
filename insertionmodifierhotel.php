<?php
include("Connexion.php");

if (!empty($_POST["ih"]) && 
!empty($_POST["nom"]) &&
 !empty($_POST["adresse"]) && 
 !empty($_POST["descriptions"]) && 
 !empty($_POST["prix"]))
  {

    $idHotel = $_POST["ih"];
    $nom = $_POST["nom"];
    $adresse = $_POST["adresse"];
    $descriptions = $_POST["descriptions"];
    $prix = $_POST["prix"];

    $imageName = null;
   if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "photo et logo/"; 
        $imageName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
    }
    $query = "UPDATE Hotels SET 
     Nom=:nom, 
     Adresse=:adresse, 
     Description=:descriptions, 
     PrixParNuit=:prix";
    if ($imageName !== null) {
        $query .= ", image = :image";
    };
    $query .= " WHERE IdHotel = :ih";
    $pdostmt = $connexion->prepare($query);
    $params=[
        "ih" => $idHotel,
        "nom" => $nom,
        "adresse" => $adresse,
        "descriptions" => $descriptions,
        "prix" => $prix,
        "image" => $newImageName
    ];
    if ($imageName !== null) {
        $params["image"] = $imageName;
    }

    $pdostmt->execute($params);
    $pdostmt->closeCursor();

    header("Location: affichagehotels.php");
    exit();
} else {
    echo "Tous les champs obligatoires ne sont pas remplis.";
}
