<?php
include("Connexion.php");

if (
    !empty($_POST["ic"]) &&
    !empty($_POST["titre"]) &&
    !empty($_POST["description"]) &&
    !empty($_POST["prix"]) &&
    !empty($_POST["duree"]) &&
    !empty($_POST["dateD"])
) {
    $imageName = null;

    // Si une image est téléchargée
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "photo et logo/"; // Dossier où enregistrer l'image
        $imageName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $imageName;

        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
    }

    $query = "UPDATE Circuits SET 
                Titre = :titre,
                Description = :description,
                Prix = :prix,
                Duree = :duree,
                DateDepart = :dateD";

    if ($imageName !== null) {
        $query .= ", image = :image";
    }

    $query .= " WHERE IdCircuit = :ic";

    $pdostmt = $connexion->prepare($query);

    $params = [
        "ic" => $_POST["ic"],
        "titre" => $_POST["titre"],
        "description" => $_POST["description"],
        "prix" => $_POST["prix"],
        "duree" => $_POST["duree"],
        "dateD" => $_POST["dateD"]
    ];

    if ($imageName !== null) {
        $params["image"] = $imageName;
    }

    $pdostmt->execute($params);
    $pdostmt->closeCursor();

    header("Location: affichagecircuit.php");
    exit();
} else {
    echo "Tous les champs obligatoires ne sont pas remplis.";
}
?>
