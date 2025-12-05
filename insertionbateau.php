<?php
include 'connexion.php';

if (
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
    !empty($_POST["prixL"]) &&
    isset($_FILES["image"]) && $_FILES["image"]["error"] === 0
) {
    // Gérer l'image
    $image_name = basename($_FILES["image"]["name"]);
    $image_tmp = $_FILES["image"]["tmp_name"];
    $upload_dir = "uploads/";
    $image_path = $upload_dir . $image_name;

    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_exts = ["jpg", "jpeg", "png", "gif"];

    if (in_array($ext, $allowed_exts)) {
        move_uploaded_file($image_tmp, $image_path);

        // Insérer dans la table
        $query = "INSERT INTO Bateaux (
            Destination, Compagnie, NumBateau, DateDepart,HeureDepart,DateArrivee, HeureArrivee,PrixCabineInterieure,PrixCabineExterieure,PrixCabineBalcon,PrixSuiteLuxe, image
        ) VALUES (
            :destination, :compagnie, :numbateau, :dateD, :heureD,:dateA, :heureA, :prixI, :prixE, :prixB, :prixL, :image
        )";

        $pdostmt = $connexion->prepare($query);
        $pdostmt->execute([
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
            "prixL" => $_POST["prixL"],
            "image" => $image_name
        ]);

        $pdostmt->closeCursor();
        header("Location: affichagebateaux.php");
        exit();
    } else {
        echo "Extension de fichier non autorisée.";
    }
} else {
    echo "Tous les champs sont obligatoires.";
}
?>
