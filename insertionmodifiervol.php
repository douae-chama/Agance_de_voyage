<?php
include("Connexion.php");

if (
    !empty($_POST["iv"]) &&
    !empty($_POST["destination"]) &&
    !empty($_POST["compagnie"]) &&
    !empty($_POST["numvol"]) &&
    !empty($_POST["dateD"]) &&
    !empty($_POST["heureD"]) &&
    !empty($_POST["dateA"]) &&
    !empty($_POST["heureA"]) &&
    !empty($_POST["prixE"]) &&
    !empty($_POST["prixB"]) &&
    !empty($_POST["prixP"])
) {
    $imageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/"; 
        $imageName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
    }
    $query = "UPDATE Vols SET 
                Destination = :destination,
                Compagnie = :compagnie,
                NumVol = :numvol,
                DateDepart = :dateD,
                HeureDepart = :heureD,
                DateArrivee = :dateA,
                HeureArrivee = :heureA,
                PrixEconomique = :prixE,
                PrixBusiness = :prixB,
                PrixPremiere = :prixP";
    if ($imageName !== null) {
        $query .= ", image = :image";
    }

    $query .= " WHERE IdVol = :iv";

    $pdostmt = $connexion->prepare($query);

    $params = [
        "iv" => $_POST["iv"],
        "destination" => $_POST["destination"],
        "compagnie" => $_POST["compagnie"],
        "numvol" => $_POST["numvol"],
        "dateD" => $_POST["dateD"],
        "heureD" => $_POST["heureD"],
        "dateA" => $_POST["dateA"],
        "heureA" => $_POST["heureA"],
        "prixE" => $_POST["prixE"],
        "prixB" => $_POST["prixB"],
        "prixP" => $_POST["prixP"]
    ];

    if ($imageName !== null) {
        $params["image"] = $imageName;
    }

    $pdostmt->execute($params);
    $pdostmt->closeCursor();

    header("Location: affuchagevols.php");
    exit();
} else {
    echo "Tous les champs obligatoires ne sont pas remplis.";
}
?>
