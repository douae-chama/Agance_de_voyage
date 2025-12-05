<?php
include("connexion.php");

if (
    !empty($_POST["ib"]) &&
    !empty($_POST["destination"]) &&
    !empty($_POST["compagnie"]) &&
    !empty($_POST["numbateau"]) &&
    !empty($_POST["dateD"]) &&
    !empty($_POST["heureD"]) &&
    !empty($_POST["dateA"]) &&
    !empty($_POST["heureA"]) &&
    !empty($_POST["prixI"]) &&
    !empty($_POST["prixE"]) &&
    !empty($_POST["prixB"]) &&
    !empty($_POST["prixL"])
) {
    $id = $_POST["ib"];
    $image_name = null;

    // Gérer le téléchargement de l'image uniquement si une nouvelle est envoyée
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $image_tmp = $_FILES["image"]["tmp_name"];
        $image_name = basename($_FILES["image"]["name"]);
        $upload_dir = "uploads/";
        $image_path = $upload_dir . $image_name;
        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_exts = ["jpg", "jpeg", "png", "gif"];

        if (in_array($ext, $allowed_exts)) {
            move_uploaded_file($image_tmp, $image_path);
        } else {
            die("Extension d'image non autorisée.");
        }
    }

    // Construction de la requête SQL dynamique (avec ou sans nouvelle image)
    $sql = "UPDATE Bateaux SET 
        Destination = :destination,
        Compagnie = :compagnie,
        NumBateau = :numbateau,
        DateDepart = :dateD,
        HeureDepart = :heureD,
        DateArrivee = :dateA,
        HeureArrivee = :heureA,
        PrixCabineInterieure= :prixI,
        PrixCabineExterieure = :prixE,
        PrixCabineBalcon = :prixB,
        PrixSuiteLuxe = :prixL";
    // Ajouter l'image uniquement si elle est changée
    if ($image_name !== null) {
        $sql .= ", image = :image";
    }

    $sql .= " WHERE IdBateau = :ib";

    $stmt = $connexion->prepare($sql);
    $params = [
        "ib" => $id,
        "destination" => $_POST["destination"],
        "compagnie" => $_POST["compagnie"],
        "numbateau" => $_POST["numbateau"],
        "dateD" => $_POST["dateD"],
        "heureD" => $_POST["heureD"],
        "dateA" => $_POST["dateA"],
        "heureA" => $_POST["heureA"],
        "prixI" => $_POST["prixI"],
        "prixE" => $_POST["prixE"],
        "prixB" => $_POST["prixB"],
        "prixL" => $_POST["prixL"]
    ];

    if ($image_name !== null) {
        $params["image"] = $image_name;
    }

    $stmt->execute($params);
    $stmt->closeCursor();

    header("Location: affichagebateaux.php");
    exit();
} else {
    echo "Veuillez remplir tous les champs obligatoires.";
}
?>
